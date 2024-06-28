import { Controller } from "@hotwired/stimulus";

export default class extends Controller {
  connect() {
    
  };

  logID = function logID(e) {
    console.log(this.id);
  }

}
