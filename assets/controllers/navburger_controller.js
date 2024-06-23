import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  static values = { state: Boolean };
  static targets = [
    "btn_menuprofil",
    "btn_menu",
    "btn_search",
    "btn_shop",
    "menu",
    "menuprofil",
  ];
  static toggle = { down: String };
  connect() {
    this.btn_menuTarget.addEventListener("click", this.toogleElement);
    this.btn_searchTarget.addEventListener("click", () => {
      this.disableAllMenu();
      alert("searche");
    });
    this.btn_shopTarget.addEventListener("click", () => {
      this.disableAllMenu();
      alert("shop");
    });
    this.btn_menuprofilTarget.addEventListener("click", this.toogleElement);
  }

  /**
   *
   * @param {MouseEvent} e
   */
  toogleElement = (e) => {
    e.preventDefault();
    const element = document.getElementById(
      e.currentTarget.dataset.navburgerToggle
    );
    if (this.downToggle == e.currentTarget.dataset.navburgerTarget) {
      element.classList.toggle("hidden");
    } else {
      this.disableAllMenu();
      element.classList.toggle("hidden");
    }
    this.downToggle = e.currentTarget.dataset.navburgerTarget;

    /** calculate new position */
    var sizeParent = element.parentElement.getBoundingClientRect();
    var sizeParentParent =
      element.parentElement.parentElement.getBoundingClientRect();
    var sizeelt = element.getBoundingClientRect();
    var curX = sizeParentParent.width - sizeelt.width + sizeParent.left;

    element.style.transform =
      "translate(" + curX + "px," + sizeParent.top + "px)";
    element.style.position = "absolute";
    element.style.inset = "0px auto auto 0px";
    element.style.margin = "0px";
  };

  disableAllMenu = function () {
    this.menuprofilTarget.classList.add("hidden");
    this.menuTarget.classList.add("hidden");
  };
}
