<template>
    <ion-page>
        <!-- Header -->
        <ion-header :translucent="true">
            <ion-toolbar>
                <ion-buttons slot="start">
                    <ion-back-button defaultHref="/"></ion-back-button>
                </ion-buttons>
                <ion-title>Actualités</ion-title>
            </ion-toolbar>
        </ion-header>

        <!-- Content -->
        <ion-content class="ion-padding">
            <div class="news-container">
                <ion-card
                    class="news-card"
                    v-for="news in newsList"
                    :key="news.id"
                    @click="viewDetails(news.id)"
                >
                    <ion-card-header>
                        <ion-card-title>{{ news.title }}</ion-card-title>
                    </ion-card-header>
                    <ion-card-content>
                        <p>
                            {{ new Date(news.created_at).toLocaleDateString() }}
                        </p>
                        <p>{{ news.excerpt }}</p>
                        <ion-button fill="clear" @click="viewDetails(news.id)"
                            >Lire la suite...</ion-button
                        >
                    </ion-card-content>
                </ion-card>
            </div>
            <ion-button @click="loadMore" v-if="currentPage < totalPages"
                >Charger plus</ion-button
            >
        </ion-content>
    </ion-page>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import {
    IonPage,
    IonHeader,
    IonToolbar,
    IonTitle,
    IonContent,
    IonCard,
    IonCardHeader,
    IonCardTitle,
    IonCardContent,
    IonButton,
    IonButtons,
    IonBackButton,
} from "@ionic/vue";
import axios from "axios";

const router = useRouter();

const newsList = ref([]);
const currentPage = ref(1);
const totalPages = ref(1);

const fetchNews = async (page) => {
    try {
        const response = await axios.get(
            `http://127.0.0.1:8000/api/news?page=${page}`
        );
        newsList.value = [...newsList.value, ...response.data.data];
        currentPage.value = response.data.current_page;
        totalPages.value = response.data.last_page;
    } catch (error) {
        console.error("Failed to fetch news:", error);
    }
};

const loadMore = () => {
    if (currentPage.value < totalPages.value) {
        fetchNews(currentPage.value + 1);
    }
};

const viewDetails = (id) => {
    router.push(`/newsdetail/${id}`);
};

onMounted(() => {
    fetchNews(currentPage.value);
});
</script>

<style scoped>
.news-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 20px;
}

ion-card-title {
    color: black;
}

.news-card {
    max-width: 400px;
    width: 100%;
    background: #e7e5e5;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}
</style>
