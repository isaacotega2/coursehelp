<!DOCTYPE html>
<html>
  <head>
      <style>
                   body{
        font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
      }
      .head-div {
      height: 30px;
      background-color: rgb(131, 97, 97);
      color: white;
    
    }

    a {
        text-decoration: none;
      }
      .sub {
  appearance: button;
  backface-visibility: hidden;
  background-color:  rgb(131, 97, 97);
  border-radius: 6px;
  border-width: 0;
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset,rgba(50, 50, 93, .1) 0 2px 5px 0,rgba(0, 0, 0, .07) 0 1px 1px 0;
  box-sizing: border-box;
  color: #fff;
  cursor: pointer;
  font-family: -apple-system,system-ui,"Segoe UI",Roboto,"Helvetica Neue",Ubuntu,sans-serif;
  font-size: 100%;
  height: 40px;
  line-height: 1.15;
  margin: 12px 0 0;
  outline: none;
  overflow: hidden;
  padding: 0 25px;
  position: relative;
  text-align: center;
  text-transform: none;
  transform: translateZ(0);
  transition: all .2s,box-shadow .08s ease-in;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  width: 150px;
  
}

.sub:disabled {
  cursor: default;
}

.sub:focus {
  box-shadow: rgba(50, 50, 93, .1) 0 0 0 1px inset, rgba(50, 50, 93, .2) 0 6px 15px 0, rgba(0, 0, 0, .1) 0 2px 2px 0, rgba(50, 151, 211, .3) 0 0 0 4px;
}
      </style>
  </head>
  <body>
    <div style=" text-align: center;
    margin: 24px 0 12px 0;">
      <img style="height: 50px;" src="cooltext412489882790884.png ">
  </div>
  
  <div id="container" style="height: 100%; width: 100%; overflow: hidden;"> 
     <div id="fist-word" style="  float: left; margin-right: 10px;" > <a href="#" style="text-decoration: none;">Funny/weird questions </a> <span>/</span> </div>
     <div id="sec-word" style="float: left; margin-right: 10px;" ><a href="#" style="text-decoration: none;"> Question and answer game  </a> <span>/</span></div>
     <div id="third-word" style="float: left; margin-right: 10px;" ><a href="#" style="text-decoration: none;">  Messages</a> <span>/</span></div>
     <div id="fourth-word" style="float: left; margin-right: 10px;" ><a href="#" style="text-decoration: none;"> Forum</a> <span>/</span></div>
     <div id="fifth-word" style="float: left; margin-right: 10px;" ><a href="#" style="text-decoration: none;">  Notifications</a> <span>/</span></div>
     <div id="sixth-word" style="float: left; margin-right: 10px;" ><a href="#" style="text-decoration: none;"> Coursehelp</a></div>
  </div> <hr>
  <div style="height: 50px; background-color: red;"> Ads</div>
    <hr>
    <div class="head-div"> <span style="display: flex; justify-content: center;"> Edit Profile</span></div>
       <br>
       <h4>Edit Profile Picture</h4>
       <input type="file">
       <hr>
       <h4>About Me </h4>
       <textarea name="post_text" rows=8 cols=40 wrap=virtual></textarea>
       <hr>
       <label><b>Also Known As</b></label>
       <input type="text"> <br> 

       <label><b>Institution</b></label>
       <input type="text"> <br>

   <label><b>Course of Study</b></label>
       <input type="text"> <br>

       <label><b>Level</b></label>
       <input type="text"> <br>

       <p><button class="sub" type="submit>">Submit</button></p>
  </body>
</html>