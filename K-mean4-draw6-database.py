import pymysql
from PIL import Image
import matplotlib.pyplot as plt
import cv2
import numpy as np

#----------------------------------------------------------------------------------------------------------#




#------------------------------------- Change the contrast stretching --------------------------------------#

# Method to process the red band of the image
def normalizeRed(intensity):

    iI      = intensity
    minI    = 86
    maxI    = 230
    minO    = 0
    maxO    = 255

    iO      = (iI-minI)*(((maxO-minO)/(maxI-minI))+minO)

    return iO

 
# Method to process the green band of the image
def normalizeGreen(intensity):

    iI      = intensity
    minI    = 90
    maxI    = 225
    minO    = 0
    maxO    = 255

    iO      = (iI-minI)*(((maxO-minO)/(maxI-minI))+minO)

    return iO

 
# Method to process the blue band of the image
def normalizeBlue(intensity):

    iI      = intensity
    minI    = 100
    maxI    = 210
    minO    = 0
    maxO    = 255

    iO      = (iI-minI)*(((maxO-minO)/(maxI-minI))+minO)

    return iO
#----------------------------------------------------------------------------------------------------------#



#---------------------------------------- Connect to the database -----------------------------------------#
server = 'localhost'
db = 'id7339167_solar_panel'
uid = 'id7339167_solar_panel'
pwd = 'solar1234'

conn = pymysql.connect(host=server,user=uid,passwd=pwd,db=db)
cursor = conn.cursor()
#----------------------------------------------------------------------------------------------------------#


#-------------------------------------------- Segmentation part --------------------------------------------#
cursor.execute("SELECT email_session FROM session where id = (SELECT max(id) FROM session)")
myresult = cursor.fetchone()
emailUser= myresult[0]

cursor.execute("SELECT project_name FROM project where status = 0 and email =%s", emailUser)
myresult = cursor.fetchone()
projectName = myresult[0]

cursor.execute("SELECT roof_image FROM project where project_name =%s", projectName)
myresult = cursor.fetchone()
blob = myresult[0]


with open("roof.png", 'wb') as file:
    file.write(blob)


origimg = img = Image.open("roof.png") 
origimg = img = img.convert("RGB")


img = np.array(img)

img = cv2.GaussianBlur(img,(15,15),5)

z = img.reshape((-1,1))
z = np.float32(z)

criteria=(cv2.TERM_CRITERIA_EPS+ cv2.TERM_CRITERIA_MAX_ITER, 20, 5.0)

K=6

ret, lable1, center1 = cv2.kmeans(z, K, None, criteria, 10, cv2.KMEANS_RANDOM_CENTERS)

center1 = np.uint8(center1)
res1 = center1[lable1.flatten()]

output1 = res1.reshape((img.shape))

first = output1

kernel = np.ones((5,5),np.uint8)
output1 = cv2.dilate(output1,kernel,iterations = 2)

#cv2.imwrite('result1.png',output1)

# convert the segmented image into object
segimg = Image.fromarray(output1)
#----------------------------------------------------------------------------------------------------------#




#**************************************************** Start Drawing part ****************************************************#

# read the energy from the database and calculate the needed number of panels
cursor.execute("SELECT energy FROM project where project_name =%s", projectName)
myresult = cursor.fetchone()
energy = myresult[0]

totalP = int((int(int(energy/30)/6)*1000)/260)


#------------- Apply contrast stretching to the original image -------------#

# Split the red, green and blue bands from the Image
multiBands      = origimg.split()

# Apply point operations that does contrast stretching on each color band
normalizedRedBand      = multiBands[0].point(normalizeRed)
normalizedGreenBand    = multiBands[1].point(normalizeGreen)
normalizedBlueBand     = multiBands[2].point(normalizeBlue) 

# Create a new image from the contrast stretched red, green and blue brands
origimg = Image.merge("RGB", (normalizedRedBand, normalizedGreenBand, normalizedBlueBand))

#---------------------------------------------------------------------------#


# get the number of pixels in the width and heigh to walk throug the image
width, height = segimg.size


# get the two images in a matrix, so we can get their colors and change it
pixdata = segimg.load()
pixorigdata = origimg.load()


#------------------------------------------- Find dominant color ------------------------------------------#

matrix = {}
matrix[0] = 1
matrix[1] = pixdata[0,0]
check = 0


# scan the rows of the image pixel by pixel
for row in range(height):

    # scan the rows of the image pixel by pixel
    for col in range(width):

        matlen = len(matrix)
        walk = 1

        while walk < matlen:
            
            rr, gg, bb = matrix[walk]
            rr2, gg2, bb2 = pixdata[col, row]

            if rr == rr2 and gg == gg2:
                matrix[walk-1] = matrix[walk-1]+1
                pixdata[col, row] = (rr, gg, bb)
                check = 1

            walk+=2


        if check == 0:
            matrix[matlen] = 1
            matrix[matlen+1] = pixdata[col, row]


        check = 0


maxDP = matrix[0]
maxDC = matrix[1]
walk = 2

while walk < len(matrix):

    if(matrix[walk] > maxDP):
        maxDP = matrix[walk]
        maxDC = matrix[walk+1]

    walk += 2


r,g,b = maxDC

#----------------------------------------------------------------------------------------------------------#



#-------------------------------------- draw a dark line in all eges --------------------------------------#

# scan the rows of the image pixel by pixel
for row in range(height):

    # scan the rows of the image pixel by pixel
    for col in range(width):

        # if we are in edge of the wall in the right then we have to leave a space with 10 pixels
        if col+7<width and pixdata[col, row] != (0,255,0) and pixdata[col, row] != (r,g,b) and pixdata[col+1, row] == (r,g,b):

            for n in range(7):
                pixdata[col+n, row] =  (0,255,0)

        
        # else if we are in edge of the wall in the top then we have to leave a space with 5 pixels
        elif row+7<height and pixdata[col, row] != (0,255,0) and pixdata[col, row] != (r,g,b) and pixdata[col, row+1] == (r,g,b):

            for n in range(7):
                pixdata[col, row+n] =  (0,255,0)


        # else if we are in edge of the wall in the top then we have to leave a space with 5 pixels
        elif row-7>0 and pixdata[col, row] != (0,255,0) and pixdata[col, row] != (r,g,b) and pixdata[col, row-1] == (r,g,b):

            for n in range(7):
                pixdata[col, row-n] =  (0,255,0)


        # else if we are in edge of the wall in the top then we have to leave a space with 5 pixels
        elif col-7>0 and pixdata[col, row] != (0,255,0) and pixdata[col, row] != (r,g,b) and pixdata[col-1, row] == (r,g,b):

            for n in range(7):
                pixdata[col-n, row] =  (0,255,0)

#----------------------------------------------------------------------------------------------------------#



#----------------------------------- some important values we will used -----------------------------------#

panelH = 36         # total number of pixel in the panel's height
panelW = 23         # total number of pixel in the panel's width
numP = 0            # number of panels installed on the rooftop

row = 0             # row index to walk throw image
col = 0             # column index to walk throw the image
rowcheck = 40       # number of rows must be checked to get the best row

maxP = 0            # maximum number of panels can be installed in the rowcheck
maxPW = 0           # first column index of maximum paneled installed
maxPH = 0           # first row index of maximum paneled installed

panelNum = 0        # number paneled installed in a specific row
panelPixW = 0       # first column index of paneled installed
panelPixH = 0       # first row index of paneled installed

checkFirst = 0      # value to check if it is the first panel will be installed (0) if it is the first, (1) if it is not the first

#----------------------------------------------------------------------------------------------------------#


#------------------------------------ draw panels in the rooftop image ------------------------------------#

for m in range(3):

    # scan the rows of the image pixel by pixel
    while row+35 < height:

        col=0

        # scan the columns of the image pixel by pixel
        while col+22 < width:

            # values used in installation so we will not affect the original walk
            r2 = row
            c2 = col


            if pixdata[c2, r2] == (r,g,b) and pixdata[c2+22,r2] == (r,g,b) and pixdata[c2, r2+35] == (r,g,b) and pixdata[c2+22,r2+35] == (r,g,b) and pixdata[c2,r2-10] != (0, 162, 232) and pixdata[c2,r2+45] != (0, 162, 232) and pixdata[c2+22,r2-10] != (0, 162, 232) and pixdata[c2+22,r2+45] != (0, 162, 232) and pixdata[c2,r2-10] != (0, 0, 0) and pixdata[c2,r2+45] != (0, 0, 0) and pixdata[c2+22,r2-10] != (0, 0, 0) and pixdata[c2+22,r2+45] != (0, 0, 0) and pixdata[c2+5,r2] != (0, 162, 232) and pixdata[c2+5,r2+35] != (0, 162, 232) and pixdata[c2+27,r2] != (0, 162, 232) and pixdata[c2+27,r2+45] != (0, 162, 232):

                panelPixH = r2
                panelPixW = c2
                panelNum += 1
                c2 = c2+23
                checkFirst = 0

                while r2 < row+rowcheck and r2+35<height:

                    while c2+22 < width:

                        if pixdata[c2,r2] == (r,g,b) and pixdata[c2+22,r2] == (r,g,b) and pixdata[c2, r2+35] == (r,g,b) and pixdata[c2+22,r2+35] == (r,g,b) and pixdata[c2,r2-10] != (0, 162, 232) and pixdata[c2,r2+45] != (0, 162, 232) and pixdata[c2+22,r2-10] != (0, 162, 232) and pixdata[c2+22,r2+45] != (0, 162, 232) and pixdata[c2,r2-10] != (0, 0, 0) and pixdata[c2,r2+45] != (0, 0, 0) and pixdata[c2+22,r2-10] != (0, 0, 0) and pixdata[c2+22,r2+45] != (0, 0, 0) and pixdata[c2+5,r2] != (0, 162, 232) and pixdata[c2+5,r2+35] != (0, 162, 232) and pixdata[c2+27,r2] != (0, 162, 232) and pixdata[c2+27,r2+45] != (0, 162, 232):
 
                            if checkFirst == 1:
                                panelPixH = r2
                                panelPixW = c2
                                checkFirst = 0

                            panelNum += 1
                            c2 = c2 + 23


                        else:
                            if panelNum > maxP and panelNum != 1:
                                maxP = panelNum
                                maxPH = panelPixH
                                maxPW = panelPixW
                            
                            panelNum = 0
                            panelPixH = 0
                            panelPixW = 0
                            checkFirst = 1
                            c2 += 1

                    c2 = 0
                    r2 += 1


                if maxP != 0:

                    print(maxP)
                    for NP in range(maxP):

                        if (totalP == numP):
                            break

                        r2 = maxPH
                        c2 = maxPW

                        if pixdata[c2, r2] == (r,g,b) and pixdata[c2+22,r2] == (r,g,b) and pixdata[c2, r2+35] == (r,g,b) and pixdata[c2+22,r2+35] == (r,g,b):

                            for pw in range(panelH):
                
                                if (totalP == numP):
                                    break

                                c2 = maxPW

                                for ph in range(panelW):

                                    if (totalP == numP):
                                        break

                                    if r2 == maxPH or r2 == (maxPH+panelH-1) or c2 == maxPW or c2 == (maxPW+panelW-1):
                                        pixdata[c2, r2] = (0, 0, 0)
                                        pixorigdata[c2,r2] = (0, 0, 0)

                                    
                                    else:
                                        pixdata[c2, r2] = (0, 162, 232)
                                        pixorigdata[c2,r2] = (0,162,232)

                                    c2 += 1
                                r2 += 1

                            maxPW = c2
                            numP += 1

                    row = maxPH + panelH + 9
                    col = width
                    maxPW = 0
                    maxPH = 0
                    maxP = 0

                else:
                    row = row+rowcheck-1
                    col = width

            col += 1

        row +=1

    row = 0
    col = 0

#----------------------------------------------------------------------------------------------------------#




#--------------------------------------- calculate important numbers --------------------------------------#

remainP = totalP - numP
per = (numP/totalP)*100
cost = 390*numP


# read the energy from the database and calculate the needed number of panels
cursor.execute("SELECT breaker FROM project where project_name =%s", projectName)
myresult = cursor.fetchone()
breaker = myresult[0]


if energy > 6000:
    ter = (6000*18) + ((energy-6000)*30)


else:
    ter = energy*18
    

bill = (ter/100) + breaker

Pbill = bill - (bill*(per/100))

payback = cost / ((bill*(per/100))*12)




#----------------------------------------------------------------------------------------------------------#



#----------------------------------- save the images and output numbers -----------------------------------#

# save image into file
origimg.save("test.png")

# open image file
file = open ('test.png','rb')
content = file.read ()
file.close ()

# save data
cursor.execute ("""
   UPDATE project
   SET status=1,panelimg=%s, installP=%s, cost=%s, remain=%s, per=%s, bill=%s, Pbill=%s, Payback =%s
   WHERE project_name=%s
""", (content, numP, cost, remainP, per, bill, Pbill, payback,projectName))
conn.commit()

#----------------------------------------------------------------------------------------------------------#