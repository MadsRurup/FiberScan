import { FontAwesome } from '@expo/vector-icons';
import { Stack, Tabs } from 'expo-router';
import React from 'react';
import { View, Text, Image} from 'react-native';

// Define your screens for the tabs
function HeaderLayout() {
  return (<Stack></Stack>)
}

// TabLayout - Define Tab Screens
function TabLayout() {
  return (
    <Tabs screenOptions={{headerStyle:{backgroundColor:"#272725"},headerTintColor: '#fff',
    headerTitleStyle: {
      fontWeight: 'bold',
    },}}>
      <Tabs.Screen
        name="shop"
        options={{
          title: 'Butik',
          tabBarIcon: ({ color, size }) => (
            <Image
              source={require('@/assets/icons/store.svg')}
              style={{ width: size, height: size, tintColor: color }}
            />) 
        }}

      />
      <Tabs.Screen
        name="index"
        options={{
          title: 'Home',
          tabBarIcon: ({ color, size }) => (
            <Image
              source={require('@/assets/icons/home.svg')}
              style={{ width: size, height: size, tintColor: color }}
            />)
        }}

      />
      <Tabs.Screen
        name="scan"
        options={{
          title: 'Scan',
          tabBarIcon: ({ color, size }) => (
            <Image
              source={require('@/assets/icons/qr.svg')}
              style={{ width: size, height: size, tintColor: color }}
            />)
        }}
      />
      <Tabs.Screen
        name="profile"
        options={{
          title: 'Profil', // Title for the tab
        }}
      />
    </Tabs>
  );
}
function Layout() {
  return (<TabLayout></TabLayout>);
}

export default Layout;
