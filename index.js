$(".scroll").click(function(event){
    event.preventDefault();
    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
});

$(".button").mousedown(function(){
  $(this).toggleClass("buttonSelected");
});


var years=[];
var subjects=[];
var dates=[];
var exams=[];
var topics=[];

$(".search").click(function(){
  $(".buttonSelected.yearButton").each(function(){
    years.push($(this).text());
  });
  $(".buttonSelected.subjectButton").each(function(){
    subjects.push($(this).text());
  });
  $(".buttonSelected.topicButton").each(function(){
    topics.push($(this).text());
  });
  $(".buttonSelected.dateAskedButton").each(function(){
    dates.push($(this).text());
  });
  $(".buttonSelected.examTypeButton").each(function(){
    exams.push($(this).text());
  });

  var input;

  for (var i = 0; i < years.length; i++) {
    input = jQuery("<input type='hidden' name=years[] value="+years[i]+">");
    jQuery('.formClass').append(input);
  }
  for (var i = 0; i < subjects.length; i++) {
    input = jQuery("<input type='hidden' name=subjects[] value="+subjects[i]+">");
    jQuery('.formClass').append(input);
  }
  for (var i = 0; i < topics.length; i++) {
    input = jQuery("<input type='hidden' name=topics[] value="+topics[i]+">");
    jQuery('.formClass').append(input);
  }
  for (var i = 0; i < dates.length; i++) {
    input = jQuery("<input type='hidden' name=dates[] value="+dates[i]+">");
    jQuery('.formClass').append(input);
  }
  for (var i = 0; i < exams.length; i++) {
    input = jQuery("<input type='hidden' name=exams[] value="+exams[i]+">");
    jQuery('.formClass').append(input);
  }
});

document.querySelector(".subjectSearch").addEventListener("input", function(){
  var input=this.value;
  $(".subjectButton").each(function(){
    if (input.trim().length===0) {
      $(this).parent().show(700);
    }else{
      if (this.innerHTML.toLowerCase().split('.').join('').replace(/\s/g,'').includes(input.toLowerCase().replace(/\s/g,'').split('.').join(''))) {
        $(this).parent().show(700);
      }else {
        $(this).parent().hide(700);
      }
    }
  });
});

document.querySelector(".dateSearch").addEventListener("input", function(){
  var input=this.value;
  $(".dateAskedButton").each(function(){
    if (input.trim().length===0) {
      $(this).parent().show(700);
    }else{
      if (this.innerHTML.toLowerCase().split('.').join('').replace(/\s/g,'').includes(input.toLowerCase().replace(/\s/g,'').split('.').join(''))) {
        $(this).parent().show(700);
      }else {
        $(this).parent().hide(700);
      }
    }
  });
});

document.querySelector(".topicSearch").addEventListener("input", function(){
  var input=this.value;
  $(".topicButton").each(function(){
    if (input.trim().length===0) {
      $(this).parent().show(700);
    }else{
      if (this.innerHTML.toLowerCase().split('.').join('').replace(/\s/g,'').includes(input.toLowerCase().replace(/\s/g,'').split('.').join(''))) {
        $(this).parent().show(700);
      }else {
        $(this).parent().hide(700);
      }
    }
  });
});
