<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор валют</title>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Калькулятор валют') }}
        </h2>
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
</head>
<body>

    <div class="container mt-5">
    <div class="card">
            <div class="card-body">
            <form id="currency-exchange-rate" action="#" method="post" class="form-group">
            <div class="row mb-3">

                    <div class="col-md-4">
                    <input type="text" name="amount" class="form-control" value="1">
                    </div>

                    <div class="col-md-4">
                    <select name="from_currency" class="form-control">
                        <option value='EUR'>EUR</option>
                        <option value='RUB'>RUB</option>
                        <option value='USD'>USD</option>
                    </select>
                    </div>

                    <div class="col-md-4">
                    <select name="to_currency" class="form-control">
                        <option value='EUR'>EUR</option>
                        <option value='RUB'>RUB</option>
                        <option value='USD'>USD</option>
                    </select>
                    </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                <input type="submit" name="submit" id="btnSubmit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150" value="перевести валюту">
                </div>
            </div>

            </form>
        </div>
        <div class="card-footer">
            <span id="output"></span>
        </div>
    </div>
    </div>
<script>
	$(document).ready(function () {

	  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

    $("#btnSubmit").click(function (event) {

        //stop submit the form, we will post it manually.
        event.preventDefault();

        // Get form
        var form = $('#currency-exchange-rate')[0];

       // Create an FormData object
        var data = new FormData(form);

       // disabled the submit button
        $("#btnSubmit").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "{{ route('exchangeCurrency.post') }}",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 800000,
            success: function (data) {

                $("#output").html(data);

                $("#btnSubmit").prop("disabled", false);

            },
            error: function (e) {

                $("#output").html(e.responseText);
                console.log("ERROR : ", e);
                $("#btnSubmit").prop("disabled", false);

            }
        });

    });

});
</script>
</body>
</html>
</x-app-layout>
