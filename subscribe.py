################################
#SOURCE: http://www.steves-internet-guide.com/into-mqtt-python-client/
###############################
import paho.mqtt.client as mqtt
import time
import sys
def on_message(client,userdata,msg):
    #callback to display the message
    topic=msg.topic
    m_decode=str(msg.payload.decode("utf-8"))
    print('===========================')
    print("Msg Received: ",m_decode) #print the decoded message
    print("Msg Topic: ",msg.topic) #print the topic
    print('===========================')

def connectToMQTT():
    broker = "mqtt.angelocaldeira.com" #my domain pointing to ec2
    client = mqtt.Client(transport='websockets') #using websockets
    client.on_message=on_message
    #print("Connecting to broker", broker)
    client.username_pw_set("angelo", "angelo123") #authentication coded in, SSL is utilised so its always encrypted
    client.tls_set() #using ssl
    client.connect(broker,8083) #specific port
    return client
def Subscribe(TOPIC):
    client = connectToMQTT()
    r = client.subscribe(f"part4/{TOPIC}") #which topic to subscribe to, must match the publisher
    print("subbed to topic!")
    client.loop_forever() #always listen for messages
    client.disconnect()

def main():
    TOPIC = sys.argv[1]
    Subscribe(TOPIC)

if __name__ == "__main__":
    main()









