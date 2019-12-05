import RPi.GPIO as GPIO
from gpiozero import Buzzer
from time import sleep
import ac_buzzer

def listen():
    print("Alarm Enabled")
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(25, GPIO.IN, pull_up_down=GPIO.PUD_UP)
    try:
        GPIO.wait_for_edge(25, GPIO.FALLING)
        while 1:
            ac_buzzer.alarmOn()
    except KeyboardInterrupt:
        GPIO.cleanup() # clean up GPIO on CTRL+C exit
    GPIO.cleanup()  # clean up GPIO on normal exit

def silence():
    print("Alarm Silenced")
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(25, GPIO.IN, pull_up_down=GPIO.PUD_UP)
    try:
        GPIO.wait_for_edge(25, GPIO.FALLING)
        ac_buzzer.alarmOff()

    except KeyboardInterrupt:
        GPIO.cleanup() # clean up GPIO on CTRL+C exit
    GPIO.cleanup()  # clean up GPIO on normal exit