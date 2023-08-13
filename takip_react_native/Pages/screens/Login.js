import React, { useEffect, useState } from 'react';


import {
    SafeAreaView,
    ScrollView,
    StatusBar,
    StyleSheet,
    Text,
    useColorScheme,
    View,
    TouchableOpacity,
    TextInput,
    Image,
  } from 'react-native';

  import axios from 'axios';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { useNavigation } from '@react-navigation/native';


const Login=({navigation})=> {
  
 const Navigasyon=useNavigation();

[kuladi,setkuladi]=useState("");
[sifre,setsifre]=useState("");
[users,setusers]=useState([]);
[durum,setdurum]=useState(true);

  useEffect(()=>{   // navigation işlemleri

    navigation.setOptions({
      headerShown: false
    })

 
  });

  useEffect(()=>{
     Girissorgu();
    
  },[]);

 const Girissorgu=async()=>{

  const sorgusonuc=await AsyncStorage.getItem("giris");
  if(sorgusonuc=="yapildi") {
      Navigasyon.navigate("Main");
  }
 };


 const Usersorgu=async()=>{

    await axios.get("xxxx").then(response=>{  // user cagirılan sunucu
      setusers(response.data);
      console.log("USERS LAR GELDİ ");
   //   console.log(users);
    }).catch(error=>console.log("HATA"));
  };

  const Login=async ()=>{
    console.log(durum);
    await Usersorgu();
    users.map(item=>{if(item.yetki=="1"){ if(item.username==kuladi && item.sifre==sifre){ 
        AsyncStorage.setItem("aisimsoyisim",item.adsoyad);
        AsyncStorage.setItem("id",item.id);
        AsyncStorage.setItem("giris","yapildi");
        Navigasyon.navigate('Main');
        setdurum(true);
  
     } else{
      setdurum(false);
     } }})

  };

  return (
    <SafeAreaView style={{flex:1,justifyContent:'center',alignItems:'center',backgroundColor:'#e6ecf3'}}>
      <View style={{justifyContent:'center',alignItems:'center',borderRadius:50,}}>
      <View style={{flexDirection:'column',marginBotto:20,justifyContent:'center',alignItems:'center'}}>
      <Image source={require('../../ptsmobile3.png')} />
        <Text style={{fontSize:28,marginTop:-20,color:"#0d4a85",fontWeight:"600"}}>
           Personel Takip Sistemi
        </Text>
        <Text style={{fontSize:20,marginTop:30,marginBottom:5,fontWeight:"500"}}>
        Kullanıcı Girişi
        </Text>
      
        </View>
    <TextInput style={{backgroundColor:"#ededed",width:270,borderRadius:30,fontSize:15,
    shadowOffset:10,shadowColor:"black",elevation:6,color:"black"}} value={kuladi} onChangeText={(kuladi)=>setkuladi(kuladi)} placeholder={"Kullanıcı Adı"}></TextInput>
    <TextInput style={{backgroundColor:"#ededed",width:270,marginTop:10,borderRadius:30,shadowOffset:10,fontSize:15,
    shadowColor:"black",elevation:6,color:"black"}} value={sifre} onChangeText={(sifre)=>setsifre(sifre)} placeholder={"Şifre"}></TextInput>
    {durum ?  <Text style={{color:"red",fontSize:16,display:'none'}}>- Kullanıcı adı veya Şifreniz Hatalı !</Text>:
    <Text style={{color:"red",fontSize:16}}>- Kullanıcı adı veya Şifreniz Hatalı !</Text> }
    <TouchableOpacity onPress={()=>Login()}>
      <Text style={{fontSize:18,textAlign:'center',padding:6,borderRadius:30,
      width:100,color:"#ededed",fontWeight:"500",marginTop:10,backgroundColor:"#0d4a85"}}>Giriş</Text>
    </TouchableOpacity>
     </View>  
    
   
    </SafeAreaView>
  )
}

export default Login;