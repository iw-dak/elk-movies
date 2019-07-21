$(document).ready(function () {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $(document).ajaxComplete(function () {
    $("[data-toggle=popover]").popover({ trigger: "hover", delay: { "show": 500, "hide": 100 }, html: true });
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
      if (Object.keys(response).length == 1) {
        $(".img-responsive").css({ width: '1000px' });
        $(".popover").css({ top: "5px", left: "-30" });
      }
    }).fail(function (xhr) {
      $(".container-large").html("Une erreur s'est produite, veuillez relancer votre recherche s'il vous plait.");
    });
  });

  $("#search-input").on("input", function (e) {
    let query = $("#search-input").val();
    if (query || query.length != 0) {
      $.ajax({
        url: '/complete',
        type: 'POST',
        data: { query: query },
      }).done(function (response) {
        let data = JSON.parse(response); console.log();
        let list = $('.ul-complete');
        $('.complete').removeClass('hide');
        for (let i = 0; i < data.length; i++) {
          for (let movie in data) {
            list.empty();
            list.append(`<li class="li-complete" id="li-${i}"> ${data[movie].name} </li>`);
          }
        }
        if (data.length == 1)
          $(".img-responsive").css({ width: '1000px' });

      }).fail(function (xhr) {
        $(".container-large").html("Une erreur s'est produite, veuillez relancer votre recherche s'il vous plait.");
      });
    }
  });

  $(document).click(function (e) {
    $('.complete').addClass('hide');
  });

  $('.complete').children().on("click", function (e) {
    $('.complete').addClass('hide');
    let query = $(this).text();

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

});
