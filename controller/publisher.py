################################
#SOURCE: http://www.steves-internet-guide.com/into-mqtt-python-client/
###############################
import paho.mqtt.client as mqtt
import time
import sys
def on_publish(client,userdata,result):
    print("data published \n")
    pass    
    
def send(TOPIC):
    broker = "mqtt.angelocaldeira.com"

    client = mqtt.Client("python1",transport='websockets')
    client.on_publish=on_publish

    print("Connecting to broker", broker)
    client.username_pw_set("angelo", "angelo123")
    client.tls_set()
    client.connect(broker,8083)
    client.loop_start()
    client.publish(f"part4/{TOPIC}",f"Your topic is {TOPIC} and this is your message!")
    time.sleep(1)
    client.loop_stop()

    client.disconnect()

def main():
    TOPIC = sys.argv[1]
    send(TOPIC)

if __name__ == "__main__":
    main()

