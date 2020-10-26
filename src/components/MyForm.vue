<template>
  <div>
    <form>
      <div class="custom-control custom-checkbox">
        <input checked type="checkbox" class="form-control statutAdd" id="statut" name="statut">
      </div>
      <div class="row">
        <div class="col">
          <label>Tâche</label>
          <input
            type="text"
            name="task_name"
            class="form-control" 
            placeholder="Tâche"
            @change="handleChange"
            :value="form.task_name"
          />
        </div>
        <div class="col">
          <label>Priorité</label>
          <select id="prio" name="prio" class="form-control" @change="handleChange" :value="form.prio">
            <option value="3">Basse</option>
            <option selected value="2" >Normal</option>
            <option value="1">Élevé</option>
          </select>
        </div>

          <button :class="btnClass" @click="onFormSubmit">
            {{ btnName }}
          </button>
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
      btnClass: "btn btn-success submit-button"
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
        this.btnClass = "btn btn-primary submit-button";

        this.clearFormFields();
      }
    },
    formValidation() {
      // first name
      if (document.getElementsByName("task_name")[0].value === "") {
        alert("Entrer une tâche");
        return false;
      }if (document.getElementsByName("prio")[0].value === "") {
        alert("Entrer une priorité");
        return false;
      }
      return true;
    },
    clearFormFields() {
      // clear form data
      this.form.task_name = "";
      this.form.prio = "2";
      this.form.statut = "0";
      this.form.isEdit = false;

      // clear form fields
    }
  },
  updated() {
    if (this.form.isEdit) {
      this.btnName = "Modifier";
      this.btnClass = "btn btn-success submit-button";
    }else{
      this.btnName = "Ajouter",
      this.btnClass = "btn btn-success submit-button"
    }
  }
};
</script>


<style scoped>
</style>