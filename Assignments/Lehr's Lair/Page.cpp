#include "Page.h"

Page::Page() {
    this->pageIndex=0;
    this->pagePic="";
    this->itemNum=0;
    this->items=NULL;
}

Page::Page(const int& pageIndex, const string& pagePic, const int& itemNum, Item* items) {
    this->pageIndex=pageIndex;
    this->pagePic=pagePic;
    this->itemNum=itemNum;
    this->items=new Item[this->itemNum];
    for(int i=0; i<this->itemNum; i++) {
        this->items[i]=items[i];
    }
}

Page::Page(const Page& orig) {
    this->pageIndex=orig.pageIndex;
    this->pagePic=orig.pagePic;
    this->itemNum=orig.itemNum;
    this->items=new Item[this->itemNum];
    for(int i=0; i<this->itemNum; i++) {
        this->items[i]=orig.items[i];
    }
}

Page::~Page() {
    delete[] this->items;
    this->items=NULL;
}

void Page::setPageIndex(const int& pageIndex) {this->pageIndex=pageIndex;}

void Page::setPagePic(const string& pagePic) {this->pagePic=pagePic;}

void Page::pushItem(const Item& item) {
    Item* temp=new Item[this->itemNum+1];
    for(int i=0; i<this->itemNum; i++) {
        temp[i]=this->items[i];
    }
    temp[this->itemNum]=item;
    this->itemNum++;
    delete[] this->items;
    this->items=temp;
    temp=NULL;
}

int Page::getPageIndex() {return this->pageIndex;}

string Page::getPagePic() {return this->pagePic;}

int Page::getItemNum() {return this->itemNum;}

const Page& Page::operator =(const Page& rhs) {
    if(this == &rhs) return *this;
    this->pageIndex=rhs.pageIndex;
    this->pagePic=rhs.pagePic;
    this->itemNum=rhs.itemNum;
    this->items=new Item[this->itemNum];
    for(int i=0; i<this->itemNum; i++) {
        this->items[i]=rhs.items[i];
    }
    return *this;
}

ostream& operator<<(ostream& out, const Page& rhs) {
    out << "Page index: " << rhs.pageIndex << endl;
    out << "Page picture: " << rhs.pagePic << endl;
    out << "Number of items in the page: " << rhs.itemNum << endl;
    out << "Items information: " << endl;
    for(int i=0; i<rhs.itemNum; i++) {
        out << "Item #" << i+1 << ": " << rhs.items[i] << endl;
    }
    return out;
}