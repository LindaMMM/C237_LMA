import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  connect() {}

  logID(item) {
    var somme = 0;
    document.querySelectorAll(".selectcredit:checked").forEach((item) => {
      somme = somme + parseInt(item.value);
    });
    document.querySelector("#form_quantite").value = somme;
    document.querySelector("#form_quantite").innerHTML = somme;
  }
}
