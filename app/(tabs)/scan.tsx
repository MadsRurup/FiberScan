import React, { useState, useEffect } from "react";
import { Text, View, StyleSheet, Button } from "react-native";
import { CameraView, Camera } from "expo-camera";

function Product() {
  const [product, setProduct] = useState({
    id: "Ford",
    name: "Mustang",
    description: "1964",
    sku: "red"
  });
}

const SkuView = ({ sku , onScanAgain}) => {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    async function getProductBySku(sku) {
      try {
        let response = await fetch(`http://api.fiberlaser-syd.dk/products?sku=${sku}`);
        let json = await response.json();
        setData(json);
      } catch (error) {
        console.error("Error fetching product:", error);
      } finally {
        setLoading(false);
        console.log("Loaded");
      }
    }

    getProductBySku(sku);
  }, [sku]); // Re-run the effect when `sku` changes

  return (
    <View style={{ backgroundColor: "#272725", width: "90%", left: "5%", padding: 10 }}>
      <Text style={{ color: "white" }}>Hello, this is a test</Text>
      {loading ? (
        <Text style={{ color: "gray" }}>Loading...</Text>
      ) : (
        <Text style={{ color: "white" }}>{JSON.stringify(data[0], null, 2)}</Text>
      )}
      <Button title={"Tap to Scan Again"} onPress={() => onScanAgain(false)} />
    </View>
  );
};

export default function App() {
  const [hasPermission, setHasPermission] = useState(false);
  const [scanned, setScanned] = useState(false);
  const [qrdata, setQrData] = useState(null)

  useEffect(() => {
    const getCameraPermissions = async () => {
      const { status } = await Camera.requestCameraPermissionsAsync();
      setHasPermission(status === "granted");
    };

    getCameraPermissions();
  }, []);

  const handleBarcodeScanned = ({ type, data }) => {
    setScanned(true);
    setQrData(data);
    alert(`Bar code with type ${type} and data ${data} has been scanned!`);
  };

  if (hasPermission === null) {
    return <Text>Requesting for camera permission</Text>;
  }
  if (hasPermission === false) {
    return <Text>No access to camera</Text>;
  }

  return (
    <View style={styles.container}>
      <CameraView
        onBarcodeScanned={scanned ? undefined : handleBarcodeScanned}
        barcodeScannerSettings={{
          barcodeTypes: ["qr", "pdf417"],
        }}
        style={StyleSheet.absoluteFillObject}
      />
      <View>{scanned && (
        
        //<Button title={"Tap to Scan Again"} onPress={() => setScanned(false)} />
        <SkuView sku={qrdata} onScanAgain={() => setScanned(false)}></SkuView>

      )}
      
      </View>
      
    </View>
  );
}



const styles = StyleSheet.create({
  container: {
    flex: 1,
    flexDirection: "column",
    justifyContent: "center",
  },
});