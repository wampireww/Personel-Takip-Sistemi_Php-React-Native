/**
 * Sample React Native App
 * https://github.com/facebook/react-native
 *
 * @format
 * @flow strict-local
 */

import { NavigationContainer, useFocusEffect } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import React, { useEffect } from 'react';
import Login from './Pages/screens/Login';
import Main from './Pages/screens/Main';


import {check, PERMISSIONS, RESULTS ,checkMultiple ,openSettings , requestMultiple} from 'react-native-permissions';

import {
  Platform,
  SafeAreaView,
  ScrollView,
  StatusBar,
  StyleSheet,
  Text,
  useColorScheme,
  View,
} from 'react-native';



const App=() => {
  
  useEffect(()=>{

  AndroidPermissions();

  })

  AndroidPermissions=()=>{
    
    const fineizin= Platform.select({android:PERMISSIONS.ANDROID.ACCESS_FINE_LOCATION});
    const coarseizin= Platform.select({android:PERMISSIONS.ANDROID.ACCESS_COARSE_LOCATION});
   
    requestMultiple([fineizin,coarseizin])
    .then((status)=>{
        if(status[fineizin]==="blocked" || status[coarseizin]==="blocked"){
            openSettings().catch((e)=>console.log(e))
        }
        
    });
    checkMultiple([fineizin,coarseizin]).then((status)=>{
      console.log("fine",status[fineizin]);
      console.log("coarse",status[coarseizin]);
     
    });
  
  }
  
  
  
  const Stack=createNativeStackNavigator();
 

  return (
    <NavigationContainer>
      <Stack.Navigator initialRouteName='Login'>
     <Stack.Screen name='Login' component={Login} />
     <Stack.Screen name='Main' component={Main} />
    </Stack.Navigator>
    </NavigationContainer>
  );
};



export default App;
