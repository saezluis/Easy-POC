function addtext() {
		var newtext = document.myform.inputtext.value;
		if (document.myform.placement[1].checked) {
			document.myform.outputtext.value = "";
			}
		document.myform.outputtext.value += newtext + " ";
		document.myform.inputtext.value = "";
		}