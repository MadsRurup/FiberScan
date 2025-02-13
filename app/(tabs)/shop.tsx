import { Text, View, StyleSheet } from "react-native";
import {Tabs, Link} from "expo-router"
import React from "react";

export default function Index() {
  return (
    <View style={styles.container}>
      <Text>Home</Text>
      <Link href="/scan">View details</Link>
      <Something></Something>
    </View>
  );
}
function Something() {
  return <View>
    
  </View>
}
const styles = StyleSheet.create({
  container: {
    flex: 1,
    justifyContent: 'center',
    alignItems: 'center',
  },
});