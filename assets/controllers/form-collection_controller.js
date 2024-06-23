import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  static values = {
    addLabel: String,
    deleteLabel: String,
  };

  connect() {
    this.index = this.element.ChildElementCount;
    const btn = document.createElement("button");
    btn.setAttribute("class", "btn btn-secondary");
    btn.innerText = this.addLabelValue || "Ajouter un élément";
    btn.setAttribute("type", "button");
    btn.addEventListener("click", this.addElement);
    this.element.childNodes.forEach(this.addDeletebutton);
    this.element.append(btn);
  }

  /**
   *
   * @param {MouseEvent} e
   */
  addElement = (e) => {
    e.preventDefault();
    const element = document
      .createRange()
      .createContextualFragment(
        this.element.dataset["prototype"].replaceAll("__name__", this.index)
      ).firstElementChild;
    this.addDeletebutton(element);
    this.index++;
    e.currentTarget.insertAdjacentElement("beforebegin", element);
  };

  /**
   *
   * @param {HTMLHtmlElement} item
   */
  addDeletebutton = (item) => {
    const btn = document.createElement("button");
    btn.setAttribute("class", "btn btn-secondary");
    btn.innerText = this.deleteLabelValue || "Supprimer";
    btn.setAttribute("type", "button");
    item.append(btn);
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      item.remove();
    });
  };
}
