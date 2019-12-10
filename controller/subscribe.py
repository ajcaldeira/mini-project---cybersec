################################
#SOURCE: http://www.steves-internet-guide.com/into-mqtt-python-client/
###############################
import paho.mqtt.client as mqtt
from  time import sleep
import sys
import ac_buzzer
import ac_int

def on_message(client,userdata,msg):
    #callback to display the message
    topic=msg.topic
    m_decode=str(msg.payload.decode("utf-8"))
    print("Msg Received: ",m_decode) #print the decoded message
    ac_buzzer.alarmOn()
    ac_int.turnOffFromMQTT()
    
def connectToMQTT():
    broker = "mqtt.angelocaldeira.com" #my domain pointing to ec2
    client = mqtt.Client(transport='websockets') #using websockets
    client.on_message=on_message
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
    
def Unsubscribe(TOPIC):
    client = connectToMQTT()
    r = client.unsubscribe(f"part4/{TOPIC}") #which topic to subscribe to, must match the publisher
    print("unsubscribed from topic!")
    client.disconnect()

def main():
    TOPIC = sys.argv[1]
    CHOICE = sys.argv[2]
    if CHOICE == 'unsub':
        Unsubscribe(TOPIC)
    else:
        Subscribe(TOPIC)

if __name__ == "__main__":
    main()









