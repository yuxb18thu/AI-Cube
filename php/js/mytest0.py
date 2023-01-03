import sys

import cv2
import numpy as np
import matplotlib.pyplot as plt

import skimage
from skimage import draw
from skimage import morphology
from skimage import data

from copy import deepcopy
from copy import deepcopy
import math


def video_demo():
  capture = cv2.VideoCapture(0)#0为电脑内置摄像头，1为摄像头外设
  while(True):
    ret, frame = capture.read()#摄像头读取,ret为是否成功打开摄像头,true,false。 frame为视频的每一帧图像
    frame = cv2.flip(frame, 1)#摄像头是和人对立的，将图像左右调换回来正常显示。
    
    imgobj = frame
    #图像转化为灰度图并进行滤波处理
    gray = cv2.cvtColor(imgobj, cv2.COLOR_BGR2GRAY)

    blurred = cv2.GaussianBlur(gray, (3, 3), 0)

    canny = cv2.Canny(blurred, 20, 40)

    kernel = np.ones((3,3), np.uint8)
    dilated = cv2.dilate(canny, kernel, iterations=2)


    #开运算，先腐蚀再膨胀，可以消除小物体小斑块
    #闭运算，先膨胀再腐蚀，可以填充孔洞（√）
    dilated=morphology.dilation(dilated,morphology.square(8))
    dilated=morphology.erosion(dilated,morphology.square(8))

    contours, hierarchy = cv2.findContours(dilated,cv2.RETR_TREE,cv2.CHAIN_APPROX_SIMPLE)  #获取图像边缘信息
    """
    candidates = []                        #图像边缘滤波
    for i in range(0,len(contours)):
        area = cv2.contourArea(contours[i])#先算面积
        if 40000<area<50000:                          #在此处修改面积值
            candidates.append(contours[i])
    """
    cv2.drawContours(imgobj, contours, -1, (0, 0, 255), 3)
    
    cv2.imshow("video", imgobj)
    c = cv2.waitKey(50)
    if c == 27:#按ESC退出
      break
def main():
    print('i am python')
   
if __name__ == '__main__':
    main()
    video_demo()
    cv2.destroyAllWindows()

    

