#include "Item.h"
Item::Item() {
    this->itemId=0;
    this->itemName="";
    this->itemPic="";
    this->itemCoordinates=new int[2];
    this->itemStatus=false;
}

Item::Item(const Item& orig) {
    this->itemId=orig.itemId;
    this->itemName=orig.itemName;
    this->itemPic=orig.itemPic;
    this->itemCoordinates = new int[2];
    this->itemCoordinates[0]=orig.itemCoordinates[0];
    this->itemCoordinates[1]=orig.itemCoordinates[1];
    this->itemStatus=orig.itemStatus;
    this->itemHotspot=orig.itemHotspot;
}

Item::Item(const int& itemId, const string& name, const string& picName, int* itemCoordinates, const Hotspot& hotspot, const bool& itemStatus) {
    this->itemId=itemId;
    this->itemName=name;
    this->itemPic=picName;
    for(int i=0; i<2; i++)    {
        this->itemCoordinates[i]=itemCoordinates[i];
    }
    this->itemStatus=itemStatus;
    this->itemHotspot=hotspot;
}

Item::~Item() {
    delete[] this->itemCoordinates;
    this->itemCoordinates = NULL;
}

void Item::setItemId(const int& itemId) {
    this->itemId=itemId;
}

void Item::setItemName(const string& itemName)   {
    this->itemName = itemName;
}

void Item::setItemPic(const string& itemPic) {
    this->itemPic = itemPic;
}

void Item::setItemStatusFalse() {this->itemStatus=false;}

void Item::setItemStatusTrue() {this->itemStatus=true;}

void Item::setItemCoordinates(const int& x, const int& y)    {
    this->itemCoordinates[0]=x;
    this->itemCoordinates[1]=y;
}

void Item::pushHotspotCoords(const int& x, const int& y)    {
    this->itemHotspot.pushPointCoordinate(x,y);
}

void Item::modifyHotspotCoords(const int& pointNum, const int& x, const int& y)    {
    this->itemHotspot.modifyPointCoordinate(pointNum,x,y);
}

int Item::getItemId() {return this->itemId;}

string Item::getItemName() {return this->itemName;}

string Item::getItemPic() {return this->itemPic;}


int Item::getItemCoordsFromTop(const int& point) {
    return this->itemCoordinates[0];    
}

int Item::getItemCoordsFromLeft(const int& point) {
    return this->itemCoordinates[1];
}

bool Item::getItemStatus() {return this->itemStatus;}

const Item& Item::operator =(const Item& rhs)
{
    if(this == &rhs) return *this;
    this->itemId=rhs.itemId;
    this->itemName=rhs.itemName;
    this->itemPic=rhs.itemPic;
    this->itemCoordinates = new int[2];
    this->itemCoordinates[0]=rhs.itemCoordinates[0];
    this->itemCoordinates[1]=rhs.itemCoordinates[1];
    this->itemStatus=rhs.itemStatus;
    this->itemHotspot=rhs.itemHotspot;
    return *this;
}

ostream& operator<<(ostream& out, const Item& rhs)
{
    out << "Item ID: " << rhs.itemId << endl;
    out << "Item Name: " << rhs.itemName << endl;
    out << "Item Picture : " << rhs.itemPic << endl;
    out << "Item position: " << endl;
    out << "From top: " << rhs.itemCoordinates[0] << "px " << endl;
    out << "From Left: " << rhs.itemCoordinates[1] << "px " << endl;
        if(rhs.itemStatus){
            out << "Item Status: True" << endl;
        }
        else {
            out << "Item Status: False" << endl;
        }
    out << rhs.itemHotspot;
    out << endl;
    return out;
}