#ifndef ITEM_H
#define ITEM_H
#include <iostream>
#include "Hotspot.h"
using namespace std;
class Item {
public:
    Item();                         //Default constructor
    Item(const Item& orig);         //Copy constructor
    Item(const int&, const string&, const string&, int*, const Hotspot&, const bool&); //Initiating constructor
    //NOTE: Passing arrays is way less complicated in JavaScript and PHP. 
    virtual ~Item();                //Destructor
    void setItemId(const int&);     //Setter for itemId ex setItemId(22) The id will help us locate different items.
    void setItemName(const string&);//Setter for name ex. setItemName("name")
    void setItemPic(const string&); //Setter for itemPic ex. setItemPic("picName")
    void setItemCoordinates(const int& fromTop, const int& fromLeft); //Pusher for the itemCoordinates array ex. pushItemCoordinates(x,y)
    void setItemStatusTrue();       //Sets the boolean value "itemStatus" true
    void setItemStatusFalse();      //Sets the boolean value "status" false
    void pushHotspotCoords(const int&, const int&);
    void modifyHotspotCoords(const int&, const int&, const int&);
    int     getItemId();            //Returns the value of itemId
    string  getItemName();          //Returns the value of name
    string  getItemPic();           //Returns the value of picName
    int     getItemCoordsFromTop(const int& point);
    int     getItemCoordsFromLeft(const int& point);
    bool    getItemStatus();        //Return the value of status
    const   Item& operator=(const Item&);                //The assignment operator
    friend  ostream& operator<<(ostream&, const Item&); //The insertion operator
    
private:
    int itemId;
    string itemName;
    string itemPic;
    int* itemCoordinates;   //{from top,from left}
    bool itemStatus;
    Hotspot itemHotspot;
};

#endif /* ITEM_H */