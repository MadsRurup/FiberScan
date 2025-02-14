import { Text, View, StyleSheet } from "react-native";
import {Tabs, Link} from "expo-router"
import React, { useEffect, useState } from "react";

async function Item() {
  const [isLoading, setLoading] = useState(true);
  const [data,setData] = useState(Object);
  try {
    let response = await fetch('http://api.fiberlaser-syd.dk/users/1');
  const json = await response.json();
  setData(json);
} catch (error) {
    console.error(error);
  } finally {
    setLoading(false)
    console.log("loaded")
  }

  return (
  <View>
    {data.id}
  </View>)
}

export default function Index() {
  const [isLoading, setLoading] = useState(true);
  const [data,setData] = useState(Object);
  async function getItems(id:number) {
    
    try {
      let response = await fetch('http://api.fiberlaser-syd.dk/products');
    const json = await response.json();
    setData(json);
  } catch (error) {
      console.error(error);
    } finally {
      setLoading(false)
      console.log("loaded")
    }
  }

  useEffect(() => {
    getItems(1);
  }, []);
  let list = [];
  console.log(data);
  for(let i = 0; i < data.length; i++) {
    console.log(i)
    console.log(data[i].name)
    list.push(<View>{data[i].name}</View>) ;
  }
  console.log(list)

  return (
    <View style={styles.container}>
      <Text>Home</Text>
      <Link href="/scan">View details</Link>
      {list}
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
})