#include "Hotspot.h"
const int BACK_HOTSPOT[]={425,562,589,718};
Hotspot::Hotspot() {
    this->pointsNum=0;
    this->coordinates=NULL;
}

Hotspot::Hotspot(const Hotspot& orig) {
    this->pointsNum=orig.pointsNum;
    for(int i=0; i<this->pointsNum; i++)    {
        int pointX= i*2;
        int pointY= pointX+1;
        this->coordinates[pointX]=orig.coordinates[pointX];
        this->coordinates[pointY]=orig.coordinates[pointY];
    }
    this->type=orig.type;
}

Hotspot::Hotspot(const int& pointsNum, int* coordinates) {
    this->pointsNum=pointsNum;
    this->coordinates=new int[(this->pointsNum*2)];
    for(int i=0; i<this->pointsNum; i++)    {
        int pointX= i*2;
        int pointY= pointX+1;
        this->coordinates[pointX]=coordinates[pointX];
        this->coordinates[pointY]=coordinates[pointY];
    }
    setType();
}

Hotspot::~Hotspot() {
    delete[] this->coordinates;
    this->coordinates=NULL;
}

void Hotspot::pushPointCoordinate(const int& x, const int& y)    {
    int* a= new int[(this->pointsNum*2+2)];
    for(int i=0; i<(this->pointsNum); i++)  {
        int pointX= i*2;
        int pointY= pointX+1;
        a[pointX]=this->coordinates[pointX];
        a[pointY]=this->coordinates[pointY];
    }
    a[((this->pointsNum+1)*2)]=x;
    a[((this->pointsNum+1)*2)+1]=y;
    this->pointsNum++;
    delete[] this->coordinates;
    this->coordinates=a;
    a=NULL;
    setType();
}

void Hotspot::modifyPointCoordinate(const int& pointNum, const int& x, const int& y)    {
    if(pointNum < this->pointsNum) {    
        int pointX=pointNum*2;
        int pointY=pointX+1;
        this->coordinates[pointX]=x;
        this->coordinates[pointY]=y;
    }
    else cout << "ERROR" << endl;
}

void Hotspot::pushBackArrowCoords() {
    for(int i=0; i<4; i++) {
        this->coordinates[i]=BACK_HOTSPOT[i];
    }
}

void Hotspot::setType() {
    if(this->pointsNum < 2) this->type="";
    else if(this->pointsNum==2) this->type="rect";
    else this->type="poly";
}

int Hotspot::getPointsNum() {return this->pointsNum;}

int Hotspot::getCoordinateX(const int& point) {
    if(point < this->pointsNum) {
        return this->coordinates[(point*2)];
    }
    else cout << "ERROR!" << endl; 
}

int Hotspot::getCoordinateY(const int& point) {
    if(point < this->pointsNum) {
        return this->coordinates[((point*2)+1)];
    }
    else cout << "ERROR!" << endl;
}

string Hotspot::getType() {return this->type;}

const Hotspot& Hotspot::operator =(const Hotspot& rhs)
{
    if(this == &rhs) return *this;
    this->pointsNum=rhs.pointsNum;
    this->coordinates=new int[this->pointsNum*2];
    for(int i=0; i<this->pointsNum; i++)    {
        int pointX= i*2;
        int pointY= pointX+1;
        this->coordinates[pointX]=rhs.coordinates[pointX];
        this->coordinates[pointY]=rhs.coordinates[pointY];
    }
    this->type=rhs.type;
    return *this;
}

ostream& operator<<(ostream& out, const Hotspot& rhs)
{
    out << "Number of points for the Hotspot: " << rhs.pointsNum << endl;
    out << "The type of Hotspot: " << rhs.type << endl;
    for(int i=0; i<rhs.pointsNum; i++){
        int pointX= i*2;
        int pointY= pointX+1;
        out << "For point #" << i+1;
        out << ": X-Coordinate: " << rhs.coordinates[pointX]; 
        out << "  Y-coordinate: " << rhs.coordinates[pointY] << endl;
    }
    out << endl;
    return out;
}

