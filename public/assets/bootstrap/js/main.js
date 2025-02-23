var shakingElements = [];

var shake = function (element, magnitude = 16, angular = false) {
  //First set the initial tilt angle to the right (+1) 
  var tiltAngle = 1;

  //A counter to count the number of shakes
  var counter = 1;

  //The total number of shakes (there will be 1 shake per frame)
  var numberOfShakes = 15;

  //Capture the element's position and angle so you can
  //restore them after the shaking has finished
  var startX = 0,
    startY = 0,
    startAngle = 0;

  // Divide the magnitude into 10 units so that you can 
  // reduce the amount of shake by 10 percent each frame
  var magnitudeUnit = magnitude / numberOfShakes;

  //The `randomInt` helper function
  var randomInt = (min, max) => {
    return Math.floor(Math.random() * (max - min + 1)) + min;
  };

  //Add the element to the `shakingElements` array if it
  //isn't already there
  if (shakingElements.indexOf(element) === -1) {
    //console.log("added")
    shakingElements.push(element);

    //Add an `updateShake` method to the element.
    //The `updateShake` method will be called each frame
    //in the game loop. The shake effect type can be either
    //up and down (x/y shaking) or angular (rotational shaking).
    if (angular) {
      angularShake();
    } else {
      upAndDownShake();
    }
  }

  //The `upAndDownShake` function
  function upAndDownShake() {

    //Shake the element while the `counter` is less than 
    //the `numberOfShakes`
    if (counter < numberOfShakes) {

      //Reset the element's position at the start of each shake
      element.style.transform = 'translate(' + startX + 'px, ' + startY + 'px)';

      //Reduce the magnitude
      magnitude -= magnitudeUnit;

      //Randomly change the element's position
      var randomX = randomInt(-magnitude, magnitude);
      var randomY = randomInt(-magnitude, magnitude);

      element.style.transform = 'translate(' + randomX + 'px, ' + randomY + 'px)';

      //Add 1 to the counter
      counter += 1;

      requestAnimationFrame(upAndDownShake);
    }

    //When the shaking is finished, restore the element to its original 
    //position and remove it from the `shakingElements` array
    if (counter >= numberOfShakes) {
      element.style.transform = 'translate(' + startX + ', ' + startY + ')';
      shakingElements.splice(shakingElements.indexOf(element), 1);
    }
  }

  //The `angularShake` function
  function angularShake() {
    if (counter < numberOfShakes) {
      console.log(tiltAngle);
      //Reset the element's rotation
      element.style.transform = 'rotate(' + startAngle + 'deg)';

      //Reduce the magnitude
      magnitude -= magnitudeUnit;

      //Rotate the element left or right, depending on the direction,
      //by an amount in radians that matches the magnitude
      var angle = Number(magnitude * tiltAngle).toFixed(2);
      console.log(angle);
      element.style.transform = 'rotate(' + angle + 'deg)';
      counter += 1;

      //Reverse the tilt angle so that the element is tilted
      //in the opposite direction for the next shake
      tiltAngle *= -1;

      requestAnimationFrame(angularShake);
    }

    //When the shaking is finished, reset the element's angle and
    //remove it from the `shakingElements` array
    if (counter >= numberOfShakes) {
      element.style.transform = 'rotate(' + startAngle + 'deg)';
      shakingElements.splice(shakingElements.indexOf(element), 1);
      //console.log("removed")
    }
  }

};

function like(iduser, idinstituicao, mudarCountUI = 1) {
    var PostData = {
      "iduser": iduser,
      "idinstituicao": idinstituicao,
      "operacao": "curtir_instituicao",
      "controller": "CurtidasController",
  };

  $.ajax({
      type: "POST",
      url: "./public/controllers/endpoint.php",
      data: PostData,
      success: function(response) {
          console.log(response);
          responseJson = JSON.parse(response);
          if (responseJson.status == 200 && responseJson.mensagem == "CURTIDO") {
              showToast("toastOperacaoConcluida");

              if(mudarCountUI){
                $('#like_id-' + idinstituicao).html(function(i, oldCount) {
                    return ++oldCount;
                });
              }

              $('#like_id-' + idinstituicao).addClass('bi-heart-fill');
              $('#like_id-' + idinstituicao).removeClass('bi-heart');
              return;
          }else if(responseJson.status == 200 && responseJson.mensagem == "DESCURTIDO"){
            showToast("toastOperacaoConcluida");

              if(mudarCountUI){
                $('#like_id-' + idinstituicao).html(function(i, oldCount) {
                    return --oldCount;
                });
              }

              $('#like_id-' + idinstituicao).addClass('bi-heart');
              $('#like_id-' + idinstituicao).removeClass('bi-heart-fill');
              return;
          }

          showToast("toastWhoops");
      },
      error: function(response) {
          showToast("toastWhoops");
      }
  });
}

function notAllowed(document, like_id) {
  shake(document.getElementById("like_id-" + like_id));

  var toastDocument = document.getElementById('toastNotAllowed');//select id of toast
  var toast = new bootstrap.Toast(toastDocument);//inizialize it
  toast.show();//show it
}


function showToast(type) {
  var toastElement = document.getElementById(type);
  var toast = new bootstrap.Toast(toastElement);
  
  toast.show();
}

function thumbsUp(iduser, idcomentario, mudarCountUI = 1) {
  var PostData = {
    "iduser": iduser,
    "idcomentario": idcomentario,
    "operacao": "curtir_comentario",
    "controller": "ComentarioController",
  };

  $.ajax({
      type: "POST",
      url: "./public/controllers/endpoint.php",
      data: PostData,
      success: function(response) {
          responseJson = JSON.parse(response);

          if (responseJson.status == 200 && responseJson.mensagem == "CURTIDO") {
              showToast("toastOperacaoConcluida");

              //incrementa contagem de joinha na UI
              if(mudarCountUI){
                $('#thumbsUp_id-' + idcomentario).html(function(i, oldCount) {
                    return ++oldCount;
                });
              }

              //remove o thumbs down se tiver (count e fill)
              $('#thumbsDown_id-' + idcomentario + '.bi-hand-thumbs-down-fill').html(function(i, oldCount) {
                  return --oldCount;
              });
              $('#thumbsDown_id-' + idcomentario + '.bi-hand-thumbs-down-fill').addClass('bi-hand-thumbs-down');
              $('#thumbsDown_id-' + idcomentario + '.bi-hand-thumbs-down-fill').removeClass('bi-hand-thumbs-down-fill');

              //adiciona o fill da joinha
              $('#thumbsUp_id-' + idcomentario).addClass('bi-hand-thumbs-up-fill');
              $('#thumbsUp_id-' + idcomentario).removeClass('bi-hand-thumbs-up');
              return;
          }else if(responseJson.status == 200 && responseJson.mensagem == "NEUTRALIZADO"){
            showToast("toastOperacaoConcluida");

              if(mudarCountUI){
                $('#thumbsUp_id-' + idcomentario).html(function(i, oldCount) {
                    return --oldCount;
                });

              }

              $('#thumbsUp_id-' + idcomentario).removeClass('bi-hand-thumbs-up-fill');
              $('#thumbsUp_id-' + idcomentario).addClass('bi-hand-thumbs-up');

              return;
          }
          showToast("toastWhoops");
      },
      error: function(response) {
          showToast("toastWhoops");
      }
  });
}

function thumbsDown(iduser, idcomentario, mudarCountUI = 1) {
  var PostData = {
    "iduser": iduser,
    "idcomentario": idcomentario,
    "operacao": "descurtir_comentario",
    "controller": "ComentarioController",
  };

  $.ajax({
      type: "POST",
      url: "./public/controllers/endpoint.php",
      data: PostData,
      success: function(response) {
          responseJson = JSON.parse(response);

          if (responseJson.status == 200 && responseJson.mensagem == "DESCURTIDO") {
              showToast("toastOperacaoConcluida");

              //incrementa joinha p baixo
              if(mudarCountUI){
                $('#thumbsDown_id-' + idcomentario).html(function(i, oldCount) {
                    return ++oldCount;
                });
              }

              //remove joinha se tiver (count e fill)
              $('#thumbsUp_id-' + idcomentario + '.bi-hand-thumbs-up-fill').html(function(i, oldCount) {
                return --oldCount;
              });
              $('#thumbsUp_id-' + idcomentario + '.bi-hand-thumbs-up-fill').addClass('bi-hand-thumbs-up');
              $('#thumbsUp_id-' + idcomentario + '.bi-hand-thumbs-up-fill').removeClass('bi-hand-thumbs-up-fill');

              $('#thumbsDown_id-' + idcomentario).addClass('bi-hand-thumbs-down-fill');
              $('#thumbsDown_id-' + idcomentario).removeClass('bi-hand-thumbs-down');
              return;
          }else if(responseJson.status == 200 && responseJson.mensagem == "NEUTRALIZADO"){
            showToast("toastOperacaoConcluida");

              if(mudarCountUI){
                $('#thumbsDown_id-' + idcomentario).html(function(i, oldCount) {
                    return --oldCount;
                });

              }

              $('#thumbsDown_id-' + idcomentario).removeClass('bi-hand-thumbs-down-fill');
              $('#thumbsDown_id-' + idcomentario).addClass('bi-hand-thumbs-down');

              return;
          }
          showToast("toastWhoops");
      },
      error: function(response) {
          showToast("toastWhoops");
      }
  });
}

function notAllowedThumbs(document, like_id, up) {
  var identifier = "thumbsUp_id-" + like_id;

  if(!up)
    identifier = "thumbsDown_id-" + like_id;

  shake(document.getElementById(identifier));

  var toastDocument = document.getElementById('toastNotAllowed');//select id of toast
  var toast = new bootstrap.Toast(toastDocument);//inizialize it
  toast.show();//show it
}