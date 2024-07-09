<template>
    <ion-page>
        <!-- Header -->
        <ion-header :translucent="true" >
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/news"></ion-back-button>
                </ion-buttons>
                <ion-title>{{ news.title }}</ion-title>
            </ion-toolbar>
        </ion-header>

        <!-- Content -->
        <ion-content :fullscreen="true" class="ion-padding">
            <div class="news-detail-container" v-if="news.title">
                
                <h1>{{ news.title }}</h1>
                <h3>
                    {{ new Date(news.created_at).toLocaleDateString() }} -
                    <em>Maracana Actu</em>
                </h3>
                <img :src="news.image" alt="News Image" class="news-image" />
                <p>{{ news.content }}</p>
                <ion-button
                    class="cta-button"
                    @click="goBackToNews"
                    expand="full"
                    >Retour à la liste des actualités</ion-button
                >
            </div>
        </ion-content>
    </ion-page>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import { defineComponent } from 'vue';
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonButtons,
    IonBackButton,
    IonButton,
} from "@ionic/vue";
import axios from "axios";

const route = useRoute();
const router = useRouter();

const news = ref({
    title: "",
    created_at: "",
    image: "",
    content: "",
});

const fetchNewsDetail = async (id) => {
    try {
        const response = await axios.get(
            `http://127.0.0.1:8000/api/news/${id}`
        );
        news.value = response.data;
    } catch (error) {
        console.error("Failed to fetch news detail:", error);
    }
};

const goBackToNews = () => {
    router.push("/news");
};

onMounted(() => {
    fetchNewsDetail(route.params.id);
});
</script>

<style scoped>
.news-detail-container {
    padding: 20px;
}

.news-image {
    width: 100%;
    border-radius: 10px;
    margin-bottom: 20px;
}

.cta-button {
    --background: #0b703c;
    --border-radius: 30px;
    --color: #ffffff;
    --padding-start: 20px;
    --padding-end: 20px;
    --transition: background-color 0.3s ease, color 0.3s ease;
}
</style>
