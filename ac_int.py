import RPi.GPIO as GPIO
from gpiozero import Buzzer
from time import sleep
import ac_buzzer
import sys


def listen():
    print("Alarm Listening")
    ac_buzzer.alarmOff()
    sleep(1)
    GPIO.setmode(GPIO.BCM)
    GPIO.setup(25, GPIO.IN, pull_up_down=GPIO.PUD_UP)
    ac_buzzer.alarmOff()
    try:
        GPIO.wait_for_edge(25, GPIO.FALLING)
        ac_buzzer.alarmOn()
        GPIO.wait_for_edge(25, GPIO.FALLING)
        ac_buzzer.alarmOff()
    except KeyboardInterrupt:
        GPIO.cleanup() # clean up GPIO on CTRL+C exit
    GPIO.cleanup()  # clean up GPIO on normal exit
    
def main():
    if sys.argv[1] == "listen":
        listen()


if __name__ == "__main__":
    main()
