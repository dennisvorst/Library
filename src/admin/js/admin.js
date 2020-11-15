/*
	Vorst Informatisering
	Dennis Vorst
	Javascript voor Honkbalmuseum - admin part. It is not loaded in the index.php on the front
*/

/* select/deselect all the checkboxes */
function handleChange() {
	/* get the vvalue in the main checkbox */
	var value = document.getElementById("checkAll").checked;

	/* get the list of checkboxes */
	var nodeList = document.querySelectorAll('[name^=check]');
	/* set the value to the other checkbox */
	var i;
	for (i = 0; i < nodeList.length; i++) {
		nodeList[i].checked = value;
	}
}