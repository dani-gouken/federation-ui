export -p > .env
gcloud storage buckets update gs://federation-assets --cors-file=gcloud-cors.json