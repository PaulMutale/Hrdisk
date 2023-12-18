<html>
<head>
    <title>E-SIGNATURE</title>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" />     
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    
    .kbw-signature {
	display: inline-block;
	border: 1px solid #a0a0a0;
	-ms-touch-action: none;
}
.kbw-signature-disabled {
	opacity: 0.35;
}
    
    
        .kbw-signature { width: 100%; height: 200px;}
        #sig canvas{ width: 100% !important; height: auto;}
    </style>  
</head>
<body class="bg-dark">
<div class="container">
   <div class="row">
       <div class="col-md-6 offset-md-3 mt-5">
           <div class="card">
               <div class="card-header">
                   <h5>E-SIGNATURE</h5>
               </div>
               <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success  alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">×</button>  
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('employees.kyc_signature_details_submit') }}">
                        @csrf
                        <div class="col-md-12">
                            <label class="" for="">Draw Signature:</label>
                            <br/>
                            <div id="sig"></div>
                            <br><br>
                            <button id="clear" class="btn btn-danger">Clear Signature</button>
                            <button class="btn btn-success">Save</button>
                            <textarea id="signature" name="signed" style="display: none"></textarea>
                        </div>
                    </form>
               </div>
           </div>
       </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{asset('esig.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui-touch-punch/0.2.3/jquery.ui.touch-punch.min.js" integrity="sha512-0bEtK0USNd96MnO4XhH8jhv3nyRF0eK87pJke6pkYf3cM0uDIhNJy9ltuzqgypoIFXw3JSuiy04tVk4AjpZdZw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>  
<script type="text/javascript">
    var sig = $('#sig').signature({syncField: '#signature', syncFormat: 'PNG'});
    $('#clear').click(function(e) {
        e.preventDefault();
        sig.signature('clear');
        $("#signature").val('');
    });
</script>
</body>
</html>
