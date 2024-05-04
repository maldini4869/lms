document.getElementById("start_period").addEventListener("change", function () {
  var startPeriod = parseInt(this.value);
  var endPeriodSelect = document.getElementById("end_period");

  // Clear previous options
  while (endPeriodSelect.childNodes.length >= 1) {
    endPeriodSelect.removeChild(endPeriodSelect.firstChild);
  }
  $(".selectpicker").selectpicker("refresh");

  // Add new options based on selected start_period
  for (var i = startPeriod + 1; i <= 10; i++) {
    var option = document.createElement("option");
    option.value = i;
    option.text = i;
    endPeriodSelect.appendChild(option);
  }
  $(".selectpicker").selectpicker("refresh");
});
