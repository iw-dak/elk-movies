
$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $("#btn-sumbmit").on('click', function (e) {

    e.preventDefault();
    let query = $("#search-input").val();

    $.ajax({
      url: '/',
      type: 'POST',
      data: { query: query },
    }).done(function (response) {
      $(".container-large").html(response.html);

    }).fail(function (xhr) {
      $(".container-large").html("Une erreur s'est produite, veuillez relancer votre recherche s'il vous plait.");
    });
  });

  $("#search-input").on("change", function (e) {
    let query = $("#search-input").val();
    $.ajax({
      url: '/complete',
      type: 'POST',
      data: { query: query },
    }).done(function (response) {
      console.log(JSON.parse(response));
      // $.each(response, function (index, value) {
      //   console.log(index + ": " + value);
      // });
      // $('.complete').removeClass('.hide');
      // $(".container-large").html(response.html);

    }).fail(function (xhr) {
      $(".container-large").html("Une erreur s'est produite, veuillez relancer votre recherche s'il vous plait.");
    });
  });
  //   $("#search-input").on("focusout", function (e) {
  // $('.complete').addClass('.hide');
  // $.ajax({
  //   url: '/',
  //   type: 'POST',
  //   data: { query: query },
  // }).done(function (response) {
  //   $(".container-large").html(response.html);

  // }).fail(function (xhr) {
  //   $(".container-large").html("Une erreur s'est produite, veuillez relancer votre recherche s'il vous plait.");
  // });
  //     });

});
