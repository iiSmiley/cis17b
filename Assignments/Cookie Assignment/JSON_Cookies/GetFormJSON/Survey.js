/*
 * Author:      Dr. Mark E. Lehr
 * Editor:      Omar Alkendi
 * Purpose:     Survey class
 */
//Constructor for the Survey
function Survey(name,description,quesNum){
    var nArgs=arguments.length;
    /* nArgs variable is used to obtain the number of argumenta
     * that has been passed to the survey class. The function "survey" is like
     * a flixable constructor, and the upcoming if statements are like 
     * the different constructors that are found in a C++ class
     */
    if(nArgs==0 || nArgs > 3) //When no arguments are provided
    {
        this.name= "";
        this.desc= "";
    }
    else if(nArgs==3)    //When all arguments are provided
    {
        this.name=name;
        this.desc=description;
        this.quesNum=quesNum;
    }
    else if(nArgs==2)   //The Survey will be created w/o questions
    {
        this.name=name;
        this.desc=description;
        this.quesNum=[];//Questions to be added using addQues()
    }
    else                //This is the copy constructor
    {
        this.name=name.name;
        this.desc=name.desc;
        this.quesNum=name.quesNum;
    }
};
//Now we can procede with all the setters and the getters
//Setting the Name
Survey.prototype.setName=function(name){
    this.name=name;
};
//Setting the Descriptiomn
Survey.prototype.setDesc=function(desc){
    this.desc=desc;
};
//Adding to the QuestionArray
Survey.prototype.addQues=function(question){
    this.quesNum.push(question);

};
//Accessing the Name
Survey.prototype.getName=function(){
  return this.name;  
};
//Accessing the Descriptition
Survey.prototype.getDesc=function(){
  return this.desc;  
};
//Accessing the questions
Survey.prototype.getQues=function(index){
  if(index>=0 && index<this.quesNum.length){
        return this.quesNum[index];
    }else{
      return "ERROR! This is not a question";
    }
};
//Accessing the number of question
Survey.prototype.getNum=function(){
  return this.number*1;  
};
//Display Function
Survey.prototype.display=function(){
    document.write("<h1>"+this.name+"</h1>");
    document.write("<h2>"+this.desc+"</h2>");
    var index = 0;
    if(this.quesNum.length !== 0){
        for (index in this.quesNum){
            document.write("<h3>Question Number: "+(index*1+1)+"</h3>");
            var a=new Question(this.quesNum[index]);
            a.display();
        }
    }else {
        document.write("<p>No questions yet</p>");
    }
};