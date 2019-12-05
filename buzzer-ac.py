import RPi.GPIO as GPIO
from time import sleep
PIN = 24
GPIO.setmode(GPIO.BCM)
GPIO.setup(PIN, GPIO.OUT)

def alarmOn():
    GPIO.output(PIN,GPIO.HIGH)
    
def alarmOff():
    GPIO.output(PIN,GPIO.LOW)
        