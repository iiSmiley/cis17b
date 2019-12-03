#ifndef PAGE_H
#define PAGE_H
#include "Item.h"
class Page {
public:
    Page();
    Page(const Page& orig);
    Page(const int&, const string&, const int&,Item*);
    //NOTE: Passing arrays is way less complicated in JavaScript and PHP. 
    virtual ~Page();
    void setPageIndex(const int&);
    void setPagePic(const string&);
    void pushItem(const Item&);
    int getPageIndex();
    string getPagePic();
    int getItemNum();
    const Page& operator=(const Page&);
    friend ostream& operator<<(ostream&, const Page&);
    
private:
    int pageIndex;
    string pagePic;
    int itemNum;
    Item* items;
};
#endif /* PAGE_H */