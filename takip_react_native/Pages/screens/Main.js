import React  from 'react';
import AsyncStorage from '@react-native-async-storage/async-storage';
import Icon from 'react-native-vector-icons/dist/FontAwesome';
import { useEffect, useState } from 'react';
import { useNavigation } from '@react-navigation/native';
import { Divider } from 'react-native-paper';
import axios from 'axios';
import Geolocation from 'react-native-geolocation-service';


import {
    SafeAreaView,
    ScrollView,
    StatusBar,
    StyleSheet,
    Text,
    useColorScheme,
    View,
    TextInput,
    TouchableOpacity,
    FlatList,
    ActivityIndicator,
  } from 'react-native';

const Main=({navigation})=> {

 
 const Navigasyon=useNavigation();

  [Adsoyad,setadsoyad]=useState("");
  [Mesajlar,setmesajlar]=useState([]);
  [Userid,setuserid]=useState("");
  [Gmesajlar,setgmesajlar]=useState([]);
  [Textmesaj,settextmesaj]=useState("");
  [İndicator,setindicator]=useState(false);
  [Geo,setgeo]=useState({latitude:"",longitude:""});
  [İnterval,setinterval]=useState(false);
  [Gelenmesaj,setgelenmesaj]=useState([]);

  useEffect(()=>{

   Sessions();
   Mesajsorgu();
   PersonelGeolocation();
  
  },[İndicator]);

  useEffect(()=>{

    GeolocationGonder();
    
  },[])


  useEffect(()=>{   // navigation options

    navigation.setOptions({

      headerStyle:{backgroundColor:"#0d4a85"},
      headerRight:()=>(<TouchableOpacity onPress={()=>Cikis()}><Icon size={26} color={"#CD201F"} name={'power-off'}/></TouchableOpacity>),
      headerLeft:()=>(<><Icon size={25} color={"#4CAF50"} name={'user-circle'} /><Text style={{ marginLeft:10,fontSize: 17,color:"#CFD8DC", fontWeight: "600" }}>{Adsoyad}</Text></>),
      title:""
      
    });

  });

  useEffect(()=>{
  
    GeolocationGonder();
    console.log(İnterval);

    return setinterval(false);

  },[İnterval])

  useEffect(() => {   // GEOLOCATİON  İNTERVAL 
    const Geodondur = setInterval(() => {

      PersonelGeolocation();
     

    }, 10000);
  
    return () => clearInterval(Geodondur);
  }, []);

  
  useEffect(() => {   // MESAJLAR İNTERVAL 
    const Mesaj = setInterval(() => {

      Mesajsorgu();
      setinterval(true);
    }, 3000);
  
    return () => clearInterval(Mesaj);
  }, []);

  ////////////////////////////// Geolocation Alma İşlemi

 const PersonelGeolocation=async()=>{
 
      Geolocation.watchPosition((position)=>{

       const{coords:{longitude,latitude}}=position  
       
       setgeo({longitude,latitude});
       GeolocationGonder();
       console.log(Geo);
      //  GeolocationGonder();
      },
      (error)=>{
        console.log("alamadım");
      },
      {enableHighAccuracy:true,timeout:10000,maximumAge:20000}
      )

 }

///////////////////////////////////////// MU SQL E GEOLOCATİON GONDERME 
  const Geoobj={

    id:Userid,
    Glatitude:Geo.latitude,
    Glongitude:Geo.longitude

  }
const GeolocationGonder=async()=>{

  
  await axios.post("",Geoobj).then(response=>{  // geolacation ı sunucuya gonder
    console.log(response.data);
  }).catch(error=>console.log("HATA"));



}

/////////////////////////////////////////////// Mysql Mesajlar Sorgu
  const Mesajsorgu=async()=>{
    
   
    await axios.get("").then(response=>{   // sunucudan mesajları al
      setmesajlar(response.data);
      console.log(Userid);
      var gelenmesaj=[];
      Mesajlar.map(item=>{if(item.alici_id==Userid){gelenmesaj.push(item)}});
      setgmesajlar(gelenmesaj.reverse());
      var Bildirimdepo=[]
      Gmesajlar.map(item=>{if(item.gonderen_id==0){Bildirimdepo.push(item)}});
      var Mmesaj=[]
      Bildirimdepo.map(item1=>Mmesaj.push(item1.mesaj));
      setgelenmesaj(Mmesaj);
      setindicator(true);
    }).catch(error=>console.log("HATA"));
    
  };

 const Sessions=async()=>{

  const girişkontrol=await AsyncStorage.getItem("giris");
  const girişkontrol2=await AsyncStorage.getItem("aisimsoyisim");
  const Userid=await AsyncStorage.getItem("id");
  setadsoyad(girişkontrol2);
  setuserid(Userid.toString());
console.log(girişkontrol);
console.log(girişkontrol2);
console.log(Userid);

  }

  const Cikis=async()=>{

      AsyncStorage.clear().then(Navigasyon.navigate("Login"));
    

  };
  //////////////////////////////////////////////  Mesaj Gönderme 
  const obj={

    isim:Adsoyad,
    gonderenid:Userid,
    gonderenyetki:"1",
    mesaj:Textmesaj,
    durum2:"geldi"
  }

  const Mesajgonder=async()=>{

    if(Textmesaj!=""){
    await axios.post("",obj).then(response=>{   // sunucuya mesajları gonder
      console.log(response);
      Mesajsorgu();
      
    }).catch(error=>console.log("HATA"));

     settextmesaj("");

  }

 

  }
////////////////////////////////////////////////////////////////
  return (
    <SafeAreaView style={{flex:1,backgroundColor:"#ECEFF1",flexDirection:'column'}}>
      
        {İndicator ? 
          <><FlatList
          inverted={true}
          data={Gmesajlar}
          renderItem={({ item }) =><View style={(item.gonderen_id == "1") ? styles.mesajgonderen : styles.mesajalici}>
            {item.gonderen_id=="1" ? 
            <><View style={{ flexDirection: 'row', alignItems: "center" }}>
                <Text style={(item.gonderen_id == "1") ? styles.mesajgonderentarih : styles.mesajalicitarih}>{item.tarih}</Text>
              </View><Text style={(item.gonderen_id == "1") ? styles.mesajgonderenbodytext : styles.mesajalicibodytext}>{item.mesaj}
                </Text></>
                :
             <><View style={{ flexDirection: 'row', alignItems: "center" }}>
                <Text style={(item.gonderen_id == "1") ? styles.mesajgonderentext : styles.mesajalicitext}>{item.gonderen}</Text>
                <Text style={(item.gonderen_id == "1") ? styles.mesajgonderentarih : styles.mesajalicitarih}>{item.tarih}</Text>
              </View><Divider style={(item.gonderen_id == "1") ? styles.dividergonderen : styles.divideralici} bold={true} /><Text style={(item.gonderen_id == "1") ? styles.mesajgonderenbodytext : styles.mesajalicibodytext}>{item.mesaj}
                </Text></>
          }
          </View>}
          keyExtractor={(item) => item.id} /><View style={{ flex: 0, flexDirection: 'row', position: "relative", bottom: 0, backgroundColor: "#0d4a85", width: '100%', alignSelf: 'center', padding: 6 }}>
            <TextInput style={{ color: "black", backgroundColor: "#ECEFF1", borderRadius: 40, width: '90%', height: 35, justifyContent: "center", alignItems: 'center' }}
              placeholder={"Lütfen bir mesaj giriniz."} value={Textmesaj} onChangeText={(text) => settextmesaj(text)}></TextInput>
            <TouchableOpacity onPress={() => Mesajgonder()} style={{ marginLeft: 6,marginTop:-1 }}><Icon size={35} 
            color={"#4CAF50"} name={'arrow-circle-o-up'} /></TouchableOpacity>
          </View></>
        : <ActivityIndicator size={30}  color={'#0d4a85'} /> }
    </SafeAreaView>
  )
}

const styles=StyleSheet.create({

    anatema:{marginTop:10},
    mesajgonderen:{marginTop:7,marginLeft:5,padding:17,marginBottom:10,backgroundColor:"#01579B",borderRadius:30,maxWidth:280,
    elevation:6,shadowOffset:20,shadowColor:"black"},
    mesajgonderentext:{color:"#bbc4d0",marginTop:-5,fontSize:15,fontWeight:"600"},
    mesajgonderenbodytext:{color:"whitesmoke",marginTop:2,fontWeight:"400"},
    mesajgonderentarih:{color:"whitesmoke",fontSize:13,position:"absolute",right:0,top:-15},
    dividergonderen:{marginTop:5,backgroundColor:"#bbc4d0"},

    mesajalici:{marginLeft:100,marginTop:7,padding:15,marginBottom:10,backgroundColor:"#bbc4d0",borderRadius:30,maxWidth:280,elevation:6,shadowOffset:20,shadowColor:"black"},
    mesajalicitext:{color:"black",marginTop:-5,fontSize:15,fontWeight:"600"},
    mesajalicibodytext:{color:"black",marginTop:2,fontWeight:"400"},
    mesajalicitarih:{color:"black",fontSize:13,position:"absolute",right:0,top:-4,fontWeight:"400"},
    divideralici:{backgroundColor:"black",marginTop:5}
});

export default Main;