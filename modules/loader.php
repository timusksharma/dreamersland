<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.loder_back{
	display:none;
	position: fixed;
	width: 100%;
	height: 100%;
	background: #fff;
	z-index: 99999999;
	opacity: 0.5;
}
.loder {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  position: relative;
  top:45%;
      left: 48%;

  width: 60px;
  height: 60px;
  -webkit-animation: spin 1s linear infinite; /* Safari */
  animation: spin 1s linear infinite;
}

/* Safari */
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
@media only screen and  (max-width: 620px)  {
    .loder{
	top:45%;
      left: 44%;
  width: 60px;
  height: 60px;
}
}

</style>
</head>
<body>
<div class="loder_back"><div class="loder"></div></div>

</body>
</html>
