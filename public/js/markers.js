function changeMarkersCoordinates(name,lat,lng) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: 'edit_coordinates',
        method: 'POST',
        data: {'name': name, 'lat':lat ,'lng':lng, token: ''}
    }).done(function (response) {

        Materialize.toast('координати збережено <br>' + response, 1000);
        console.log(response);
    }).fail(function (err) {

        alert('щось пішло не так, помилка -'+err+' зверніться до адміністратора');
    });
}