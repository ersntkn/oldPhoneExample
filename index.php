  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Old Phone Example</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="./assets/alerts/css/iziToast.min.css">
    <link rel="stylesheet" href="./assets/fonts/fontawesome/css/all.min.css">
  </head>
  <body>
    <div class="container mt-5">
      <div class="row">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-4 m-auto">
          <div class="mobile-phone">
            <div class="phone-screen m-auto">
              <div id="screen"></div>
              <div id="screenResult"></div>
              <input type="hidden" readonly id="screenNewDates" value="">
            </div>
            <div class="phone-keyboard">
              <div  class="numbers text-center">
                <div class="row m-0">
                  <div class="col-6 m-0 p-0">
                    <button id="refresh" type="button" name="button" class="btn btn-md btn-warning m-0 p-0"><i class="buttonIcon fas fa-sync"></i><b class="buttonSpecialName">Refresh</b></button>
                  </div>
                  <div class="col-6 m-0 p-0">
                    <button id="backspace" type="button" name="button" class="btn btn-md btn-secondary m-0 p-0"><i class="buttonIcon fa fa-arrow-left"></i><b class="buttonSpecialName">Back</b></button>
                  </div>
                  <div id="1" class="col-4 click">
                    <span><br><b>1</b></span>
                  </div>
                  <div id="2" class="col-4 click">
                    <span>ABC<br><b>2</b></span>
                  </div>
                  <div id="3" class="col-4 click">
                    <span>DEF<br><b>3</b></span>
                  </div>
                  <div id="4" class="col-4 click">
                    <span>GHI<br><b>4</b></span>
                  </div>
                  <div id="5" class="col-4 click">
                    <span>JKL<br><b>5</b></span>
                  </div>
                  <div id="6" class="col-4 click">
                    <span>MNO<br><b>6</b></span>
                  </div>
                  <div id="7" class="col-4 click">
                    <span>PQRS<br><b>7</b></span>
                  </div>
                  <div id="8" class="col-4 click">
                    <span>TUV<br><b>8</b></span>
                  </div>
                  <div id="9" class="col-4 click">
                    <span>WXYZ<br><b>9</b></span>
                  </div>
                  <div id="*" class="col-4 click">
                    <span><br><b>*</b></span>
                  </div>
                  <div id="0" class="col-4 click">
                    <span><br><b>0</b></span>
                  </div>
                  <div id="#" class="col-4 click">
                    <span><br><b>#</b></span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

  <script src="./assets/alerts/js/iziToast.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script type="text/javascript">
  $(document).on('click', ".click", function(){
    /* This function works when we click on any button in the click class. */
    const id  = $(this).attr('id');
    /* We get the ID number of the button we pressed to understand which button it is. */
    if (/^[2-9]$/.test(id)) {
      const datetime = Date.parse(new Date);
      const newScreen  = $('#screen').html($('#screen').html() +id);
      /* If a button was pressed before, we add the ID of the button after the old number, if not, we add the ID of the newly pressed button. */
      const newDates  = $('#screenNewDates').val($('#screenNewDates').val() + datetime);
        /* If a button has been pressed before and the date of the button has been added, we add to it after it, otherwise we add the date of the new button press.*/
      const trimmedNumber = $('#screen').html().trim();
      const screenNewDates = $('#screenNewDates').val();
      const newDatesTrimmed = screenNewDates.trim();
      /* We used the trim method because we wanted no spaces between the numbers. */
      bringTheData(trimmedNumber,newDatesTrimmed);

    }else {
      iziToast.info({
        title: "",
        message: 'You dont have permission for that number or char',
        position : "topCenter"
      });
    }
  });

  $(document).on('click', "#refresh", function(){
    iziToast.success({
      title: "",
      message: 'Page Refreshing.',
      position : "topCenter"
    });
    setTimeout(function(){
      location.reload();
    }, 1000);
  });

  $(document).on('click', "#backspace", function(){
    if (($('#screen').html()).length == 1) {
        location.reload();
    }else if (($('#screen').html()).length != 0 && ($('#screen').html()).length != 1) {
      const newScreenEdited = $('#screen').html().trim().slice(0, -1);
      $('#screen').html(newScreenEdited)
      const newDatesEdited  = $('#screenNewDates').val().slice(0, -13);
      $('#screenNewDates').val(newDatesEdited)
      bringTheData(newScreenEdited,newDatesEdited);
    }else {
      iziToast.info({
        title: "",
        message: 'This process does not work on empty value',
        position : "topCenter"
      });
    }
  });


  function bringTheData(trimmedNumberValue,newDatesTrimmedValue){
    $.ajax({
      url: "<?php echo "./api/api.php";?>",
      type: "POST",
      data: {trimmedNumber:trimmedNumberValue,newDatesTrimmed:newDatesTrimmedValue},
      success: function(dataResult){
        var dataResult = JSON.parse(dataResult);
        if(dataResult.statusCode==200){
            $('#screenResult').html(dataResult.data)
        }else {
          iziToast.error({
            title: "",
            message: dataResult.data,
            position : "topCenter"
          });
        }
        /* Every time the button is pressed, we query the API and print the result returned to us on the screen. */
      }
    });
  }


  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>
  </html>
