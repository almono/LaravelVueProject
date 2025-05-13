<template>
  <div>
    <BNavItemDropdown class="navbar-dropdown" text="Lang" right>
      <template #button-content>
        <span class="material-icons">language</span>
      </template>
      <BDropdownItem disabled>{{ $t('welcome') }}</BDropdownItem>
      <BDropdownItem @click="switchLanguage('en')">EN</BDropdownItem>
      <BDropdownItem @click="switchLanguage('pl')">PL</BDropdownItem>
    </BNavItemDropdown>
  </div>
</template>

<script setup>
import { useI18n } from 'vue-i18n';
import { useTranslationsStore } from '../../../stores/settings/translationsStore';

const translationStore = useTranslationsStore();
const { locale, messages } = useI18n();  // `useI18n` should be called at the top

async function switchLanguage(lang) {
  // Fetch translations and update both i18n and Pinia store
  const newMessages = await translationStore.setLocale(lang);
  messages.value[lang] = newMessages;  // Update the locale's messages
  locale.value = lang;  // Change the locale in vue-i18n
}
</script>
