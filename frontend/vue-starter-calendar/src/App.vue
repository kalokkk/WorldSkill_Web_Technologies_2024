<script setup>
import { ref } from 'vue';

const dates = ref([]);
const isEditing = ref(false);

const attributes = ref([
  {
    highlight: true,
    dates: dates,
  }
]);

const onClick = (item) => {
  if (!isEditing.value) return;

  if (dates.value.includes(item.id)) return;

  dates.value.push(item.id)
  dates.value = dates.value.sort((a, b) => new Date(a) - new Date(b));
}

</script>

<template>
  <main>
    <label for="editing" style="display: block;">
      Edit Mode:
      <input type="checkbox" v-model="isEditing" name="editing" id="editing">
    </label>

    <VCalendar :attributes="attributes" @dayclick="onClick" />
    <!-- <VDatePicker v-model="date" /> -->

    <ol class="date-list" v-if="dates.length">
      <li v-for="date in dates">
        {{ date }}
      </li>
    </ol>
  </main>
</template>

<style scoped>
.date-list {
  display: flex;
  flex-direction: column;
}
</style>
