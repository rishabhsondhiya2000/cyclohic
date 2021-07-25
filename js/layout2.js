const open_nav = () => {
  var width = document.getElementById("mob_nav").offsetWidth;
  if (width > 0) {
      // console.log("open");
      document.getElementById("mob_nav").style.width = "0vw";
  } else {
      //   console.log("close");
        document.getElementById("mob_nav").style.width = "60vw";
      //   document.getElementById("main").style.overflowY = "scroll";
  }
};

