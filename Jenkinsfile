pipeline {
    agent any
    
    environment {
        PROJECT_NAME = 'ShareRide'
        STUDENT_NAME = 'Gustave Karekezi'
        REG_NUMBER = '24RP14238'
    }
    
    stages {
        stage('Checkout') {
            steps {
                echo "========================================="
                echo "Checkout stage is running"
                echo "Project: ${PROJECT_NAME}"
                echo "Student: ${STUDENT_NAME}"
                echo "Reg No: ${REG_NUMBER}"
                echo "========================================="
                checkout scm
            }
        }
        
        stage('Build') {
            steps {
                echo "========================================="
                echo "Build stage is running"
                echo "Building Docker images..."
                echo "========================================="
                script {
                    sh 'docker-compose build'
                }
            }
        }
        
        stage('Test') {
            steps {
                echo "========================================="
                echo "Test stage is running"
                echo "Running application tests..."
                echo "========================================="
                script {
                    // Add your test commands here
                    sh 'echo "Testing PHP syntax..."'
                    sh 'find ./src -name "*.php" -exec php -l {} \\;'
                }
            }
        }
        
        stage('Deploy') {
            steps {
                echo "========================================="
                echo "Deploy stage is running"
                echo "Deploying containers..."
                echo "========================================="
                script {
                    sh 'docker-compose up -d'
                }
            }
        }
        
        stage('Verify') {
            steps {
                echo "========================================="
                echo "Verify stage is running"
                echo "Verifying deployment..."
                echo "========================================="
                script {
                    sh 'docker-compose ps'
                    sh 'echo "Application is running on http://localhost:8080"'
                }
            }
        }
    }
    
    post {
        success {
            echo "========================================="
            echo "Pipeline completed successfully!"
            echo "Student: ${STUDENT_NAME}"
            echo "Reg No: ${REG_NUMBER}"
            echo "========================================="
        }
        failure {
            echo "========================================="
            echo "Pipeline failed!"
            echo "Please check the logs for errors."
            echo "========================================="
        }
        always {
            echo "========================================="
            echo "Cleaning up..."
            echo "========================================="
        }
    }
}