<?php 
    echo '<footer class="page-footer dark">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <h5>Get started</h5>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Sign up</a></li>
                    <li><a href="#">Downloads</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>About us</h5>
                <ul>
                    <li><a href="#">Company Information</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Reviews</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Support</h5>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Help desk</a></li>
                    <li><a href="#">Forums</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <h5>Legal</h5>
                <ul>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© 2022 Copyright Text</p>
    </div>
</footer>
<script>
$.extend( $.validator.messages, {
	required: "Tento údaj je povinný.",
	remote: "Prosím, opravte tento údaj.",
	email: "Prosím, zadejte platný e-mail.",
	url: "Prosím, zadejte platné URL.",
	date: "Prosím, zadejte platné datum.",
	dateISO: "Prosím, zadejte platné datum (ISO).",
	number: "Prosím, zadejte číslo.",
	digits: "Prosím, zadávejte pouze číslice.",
	creditcard: "Prosím, zadejte číslo kreditní karty.",
	equalTo: "Prosím, zadejte znovu stejnou hodnotu.",
	extension: "Prosím, zadejte soubor se správnou příponou.",
	maxlength: $.validator.format( "Prosím, zadejte nejvíce {0} znaků." ),
	minlength: $.validator.format( "Prosím, zadejte nejméně {0} znaků." ),
	rangelength: $.validator.format( "Prosím, zadejte od {0} do {1} znaků." ),
	range: $.validator.format( "Prosím, zadejte hodnotu od {0} do {1}." ),
	max: $.validator.format( "Prosím, zadejte hodnotu menší nebo rovnu {0}." ),
	min: $.validator.format( "Prosím, zadejte hodnotu větší nebo rovnu {0}." ),
	step: $.validator.format( "Musí být násobkem čísla {0}." )
} );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
<script src="assets/js/smoothproducts.min.js"></script>
<script src="assets/js/theme.js"></script>';
?>