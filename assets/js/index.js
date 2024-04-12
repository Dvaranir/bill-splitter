function capitalizeFirstLetter(string) {
  return string.charAt(0).toUpperCase() + string.slice(1);
}

class Validator {
  static validate(input, rules) {
    let result = { errors: {} };

    for (let key in rules) {
      let ruleSet = rules[key].split("|");

      for (let rule of ruleSet) {
        if (rule === "required" && !input[key]) {
          result.errors[key] = `${key} field is required`;
        }

        if (rule === "email" && !Validator.validateEmail(input[key])) {
          result.errors[key] = `${key} field must be a valid email address`;
        }

        if (rule === "numeric" && isNaN(input[key])) {
          result.errors[key] = `${key} field must be a number`;
        }

        if (rule.startsWith("min")) {
          let min = parseInt(rule.split(":")[1]);
          if (input[key].length < min) {
            result.errors[
              key
            ] = `${key} field must be at least ${min} characters`;
          }
        }

        if (rule.startsWith("max")) {
          let max = parseInt(rule.split(":")[1]);
          if (input[key].length > max) {
            result.errors[
              key
            ] = `${key} field must be at most ${max} characters`;
          }
        }
      }
    }

    return result;
  }

  static validateEmail(email) {
    let re =
      /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
  }
}
class SplitterForm {
  constructor(splitterTable) {
    this.nameElement = document.getElementById("splitterName");
    this.emailElement = document.getElementById("splitterEmail");
    this.splitterButton = document.getElementById("splitterButton");
    this.isSubmited = false;

    this.splitterTable = splitterTable;

    this.nameElement.addEventListener("input", this.validate.bind(this));
    this.emailElement.addEventListener("input", this.validate.bind(this));
    this.splitterButton.addEventListener("click", this.submit.bind(this));
  }

  validate() {
    if (!this.isSubmited) return;

    let input = {
      name: this.nameElement.value,
      email: this.emailElement.value,
    };

    let rules = {
      name: "required|min:3",
      email: "required|email",
    };

    let result = Validator.validate(input, rules);

    const inputKeys = Object.keys(input);
    const errorsKeys = Object.keys(result.errors);

    inputKeys.forEach((key) => {
      if (!errorsKeys.includes(key)) {
		const capitalizedKey = capitalizeFirstLetter(key);
		const element = document.getElementById(`splitter${capitalizedKey}`);
        const errorElement = document.getElementById(
          `splitter${capitalizeFirstLetter(key)}Error`
        );
		element.classList.remove("invalid");
        errorElement.innerHTML = "";
      }
    });

    if (errorsKeys.length > 0) {
      errorsKeys.forEach((key) => {
		const capitalizedKey = capitalizeFirstLetter(key);
		const element = document.getElementById(`splitter${capitalizedKey}`);
        const errorElement = document.getElementById(
          `splitter${capitalizeFirstLetter(key)}Error`
        );
		element.classList.add("invalid");
        errorElement.innerHTML = result.errors[key];
      });

      return false;
    }

    return true;
  }

  async submit() {
    this.isSubmited = true;
    if (this.validate()) {
      try {
        const response = await fetch(
          "/api/index.php?controller=Users&suffix=BillUser",
          {
            headers: {
              "Content-type": "application/json; charset=UTF-8",
            },
            method: "POST",
            body: JSON.stringify({
              name: this.nameElement.value,
              email: this.emailElement.value,
            }),
          }
        );
        if (response.status === 200) {
          const data = await response.json();
          this.splitterTable.render(data);

          this.nameElement.value = "";
          this.emailElement.value = "";
          this.isSubmited = false;
        }
      } catch (error) {
      } finally {
      }
    }
  }
}

class SplitterTable {
  constructor() {
    this.tableElement = document.querySelector("#splitterTable tbody");
    this.fetchData();
  }

  async fetchData() {
    try {
      const response = await fetch(
        "/api/index.php?controller=Users&suffix=BillUsers"
      );
      if (response.status === 200) {
        const data = await response.json();
        this.render(data);
      }
    } catch (error) {}
  }

  render(data) {
    let html = [];

    data.forEach((user) => {
      html.push(`
			<tr>
				<td>${user.name}</td>
				<td>${user.email}</td>
				<td>${user.to_pay}€</td>
			</tr>
		`);
    });
    this.tableElement.innerHTML = html.join("");
  }

  async reset() {
    try {
      const response = await fetch(
        "/api/index.php?controller=Users&suffix=BillUsers",
        {
          headers: {
            "Content-type": "application/json; charset=UTF-8",
          },
          method: "DELETE",
          body: JSON.stringify({}),
        }
      );
      if (response.status === 200) {
        this.tableElement.innerHTML = "";
      }
    } catch (error) {
    } finally {
    }
  }
}

class SplitterResetButton {
  constructor(splitterTable) {
    this.resetButton = document.getElementById("splitterResetButton");
    this.splitterTable = splitterTable;

    this.resetButton.addEventListener(
      "click",
      this.splitterTable.reset.bind(this.splitterTable)
    );
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const splitterTable = new SplitterTable();
  const splitterForm = new SplitterForm(splitterTable);
  const resetButton = new SplitterResetButton(splitterTable);
});
