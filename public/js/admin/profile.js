$(document).ready(function() {
  


  getuser()

  function getuser() {
    $.ajax({
      type: "GET",
      url: "/api/grabusers",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        Authorization:
            "Bearer " + $('meta[name="api_token"]').attr("content"),
    },
      data: { 
        show: true
      },
      dataType: "json",
      success: function (users) {
        var user = users[0]
        var account_id = user.account_id
        var first_name = user.first_name
        var last_name = user.last_name 
        var username = user.username
        var password = user.password
        var email = user.email
        var contact_number = user.contact_number
        var user_type = user.user_type
        var name = first_name + ' ' + last_name

        $('#account_id').val(account_id)
        $('#name').val(name)
        $('#email').val(email)
        $('#username').val(username)
        $('#contact_number').val(contact_number)

        $('#modal_account_id').val(account_id)
        $('#modal_first_name').val(first_name)
        $('#modal_last_name').val(last_name)
        $('#modal_username').val(username)
        $('#modal_password').val(password)
        $('#modal_email').val(email)
        $('#modal_contact_number').val(contact_number)
      },
      error: function(xhr, textStatus, errorThrown) {
        swal({
          title: 'Error',
          icon: 'error'
        })
        console.log('Error:', textStatus, errorThrown, xhr.responseText)
      }
    })
  }

  $('#edit').submit(function(event) {
    event.preventDefault()
    var formData = new FormData(this)

    $.ajax({
      type: "POST",
      url: "/api/edituser",
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        Authorization:
            "Bearer " + $('meta[name="api_token"]').attr("content"),
    },
      data: formData,
      dataType: "json",
      processData: false,
      contentType: false,
      success: function (response) {
        if (response.hasOwnProperty('failed')) {
          swal({
            title: 'Failed to add',
            text: 'There seems to be an error, contact the administrator',
            icon: 'error'
          })
          console.log(response)
        } else if (response.hasOwnProperty('exists')) {
          swal({
            title: 'Exists',
            text: 'This email is already in use',
            icon: 'warning'
          })
        } else {
          swal({
            title: response.title,
            text: response.text,
            icon: response.icon
          })
          var user = response
          var first_name = user.first_name
          var last_name = user.last_name 
          var username = user.username
          var email = user.email
          var contact_number = user.contact_number
          var user_type = user.user_type
          var name = first_name + ' ' + last_name
  
          $('#name').val(name)
          $('#email').val(email)
          $('#username').val(username)
          $('#contact_number').val(contact_number)
        }
      },
      error: function(xhr, textStatus, errorThrown) {
        swal({
          title: 'Error',
          icon: 'error'
        })
        console.log('Error:', textStatus, errorThrown, xhr.responseText)
      }
    })
  })

})