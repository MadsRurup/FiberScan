import { Text, View, StyleSheet } from "react-native";
import {Tabs, Link} from "expo-router"
import React from "react";

export default function Index() {
  return (
    <View style={styles.container}>
      <Text>Profile1234</Text>
      <Link href="/scan">View details</Link>
      <Menu></Menu>
      
    </View>
  );
}

function Menu() {
  return(<View style={styles.menu}>
    <MenuItem title="Min profil" url="/settings"></MenuItem>
    <MenuItem title="Firma" url="/cart"></MenuItem>
    <MenuItem title="Indkøbskurv" url="/cart"></MenuItem>
    <MenuItem title="Indstillinger" url="/settings"></MenuItem>
    </View>)
}

function MenuItem({title, url}) {
  console.log({url})
  return (<View >
    <Link style={styles.menuItem} href={url}>{title}</Link>
  </View>)

}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
  menuItem: {
    borderTopWidth: 1,
    borderTopColor: "#303030",
    width: "100%",
    textAlign: "center",
    alignContent: "center",
    backgroundColor: "#efefef"
  },
  menu: {
    width: "100%",
    bottom: "0",
    backgroundColor: "#efefef"
    
  }


});

