<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter, watchEffect } from 'vue-router'

const route = useRoute();
const router = useRouter();

const title = ref("Your Title...");
const dates = ref([]);
const isEditing = ref(false);

const attributes = ref([
  {
    highlight: true,
    dates: dates,
  }
]);

// watchEffect(() => {

// });

const onClick = (item) => {
  if (!isEditing.value) return;

  if (dates.value.includes(item.id)) {
    dates.value = dates.value.filter(date => date != item.id);
    return;
  }

  dates.value.push(item.id);
  console.log(dates.value);
  dates.value = dates.value.sort((a, b) => new Date(a) - new Date(b));
  const value = encode(dates.value.toString());
  replaceParams(
    "dates",
    value
  );
}

const replaceParams = (key, newParams) => {
  router.push({ query: { ...route.query, [key]: newParams } });
}

const encode = (value) => {
  return btoa(value);
}

const decode = (value) => {
  return atob(value);
}

onMounted(async () => {
  await router.isReady();

  if (!route.query.dates) return;
  const datesQuery = decode(route.query.dates);

  dates.value = datesQuery.split(",");
  console.log("attribute: ", attributes.value);
  attributes.value.dates = dates;
})

</script>

<template>
  <main style="display: flex; gap: 6rem;">
    <div class="left">
      <h1 v-if="title">{{ title }}</h1>     

      <VCalendar :attributes="attributes" @dayclick="onClick" />
      <!-- <VDatePicker v-model="date" /> -->

      <div class="">
        <h2>Selected Dates:</h2>
        <ol class="date-list" v-if="dates.length">
          <li v-for="date in dates">
            {{ date }}
          </li>
        </ol>
      </div>
    </div>

    <div class="right">
      <label for="editing" style="display: block;">
        Edit Mode:
        <input type="checkbox" v-model="isEditing" name="editing" id="editing">
      </label>

      <label for="title">
        Title:
        <input type="url" name="title" v-model="title" id="title">
      </label>
    </div>
  </main>
</template>

<style scoped>
.date-list {
  display: flex;
  flex-direction: column;
}
ol {
  padding-left: 18px;
}
.left {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.right {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
</style>
