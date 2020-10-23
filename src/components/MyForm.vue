<template>
  <div class="my-form">
    <form class="ui form">
      <div class="fields">
        <div class="nine wide field">
          <label>Tâche</label>
          <input
            type="text"
            name="task"
            placeholder="Tâche"
            @change="handleChange"
            :value="form.task"
          />
        </div>

        <div class="six wide field">
          <label>Priorité</label>
          <select id="inputState" class="form-control" @change="handleChange" :value="form.prio">
            <option selected >Normal</option>
            <option>Haute</option>
            <option>Basse</option>
          </select>
        </div>

        <div class="two wide field">
          <button :class="btnClass" @click="onFormSubmit">
            {{ btnName }}
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "MyForm",
  data() {
    return {
      btnName: "Ajouter",
      btnClass: "ui green button submit-button"
    };
  },
  props: {
    form: {
      type: Object
    }
  },
  methods: {
    handleChange(event) {
      const { name, value } = event.target;
      let form = this.form;
      form[name] = value;
      this.form = form;
    },
    onFormSubmit(event) {
      event.preventDefault();

      if (this.formValidation()) {
        this.$emit("onFormSubmit", this.form);

        this.btnName = "Ajouter";
        this.btnClass = "ui primary button submit-button";

        this.clearFormFields();
      }
    },
    formValidation() {
      // first name
      if (document.getElementsByName("task")[0].value === "") {
        alert("Entrer une tâche");
        return false;
      }

      // last name
      if (document.getElementsByName("prio")[0].value === "") {
        alert("Enter last name");
        return false;
      }

      return true;
    },
    clearFormFields() {
      // clear form data
      this.form.task = "";
      this.form.prio = "";
      this.form.isEdit = false;

      // clear form fields
      document.querySelector(".form").reset();
    }
  },
  updated() {
    if (this.form.isEdit) {
      this.btnName = "Modifier";
      this.btnClass = "ui orange button submit-button";
    }
  }
};
</script>

