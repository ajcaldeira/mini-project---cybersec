from cv2 import *
import time
from picamera import PiCamera
from time import sleep
def takeSavePic():
    
    camera = PiCamera()
    camera.resolution = (1920, 1080)
    camera.start_preview()
    #sleep(2)
    TIME_NAME = int(time.time())
    PIC_NAME = f"{TIME_NAME}.jpg"
    camera.capture('/var/www/html/' + PIC_NAME)
    camera.stop_preview()
    
    return PIC_NAME