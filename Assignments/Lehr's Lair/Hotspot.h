#ifndef HOTSPOT_H
#define HOTSPOT_H
#include "cstdlib" //To assign NULL
#include <iostream>
using namespace std;
class Hotspot {
public:
    Hotspot();
    Hotspot(const Hotspot& orig);
    Hotspot(const int&, int*);
    //NOTE: Passing arrays is way less complicated in JavaScript and PHP. 
    virtual ~Hotspot();
    void pushPointCoordinate(const int& x, const int& y); //Pusher for the itemCoordinates array ex. pushItemCoordinates(x,y)
    void modifyPointCoordinate(const int& point, const int& x, const int& y);    //Modify a point in the itemCoordinates array ex. modifyItemCoordinates(1,x,y)
    void pushBackArrowCoords();
    int     getPointsNum(); //Returns the value of coordinateNum
    int     getCoordinateX(const int& point);
    int     getCoordinateY(const int& point);
    string  getType();
    const   Hotspot& operator=(const Hotspot&);                //The assignment operator
    friend  ostream& operator<<(ostream&, const Hotspot&); //The insertion operator
private:
    int pointsNum;
    int* coordinates;
    string type;        //rect or poly?
    void setType();
};

#endif /* HOTSPOT_H */