import face_recognition 
import cv2
import numpy as np
import csv
import os
from datetime import datetime

# Initialize video capture
video_capture = cv2.VideoCapture(0)

# Load known face encodings and names
jobs_image = face_recognition.load_image_file("photo/Durga.jpeg")
jobs_encoding = face_recognition.face_encodings(jobs_image)[0]

ratan_tata_image = face_recognition.load_image_file("photo/Saugat.jpeg")
ratan_tata_encoding = face_recognition.face_encodings(ratan_tata_image)[0]

sadmona_image = face_recognition.load_image_file("photo/Ayusha.jpeg")
sadmona_encoding = face_recognition.face_encodings(sadmona_image)[0]

# Shubam = face_recognition.load_image_file("photo/shubam.jpg")
# Shubam_encoding = face_recognition.face_encodings(sadmona_image)[0]

known_face_encoding = [
    jobs_encoding,
    ratan_tata_encoding,
    sadmona_encoding,
]

known_faces_names = [
    "Durga",
    "Saugat",
    "Ayusha"
]

# Initialize students list
students = known_faces_names.copy()

# Create a CSV file for attendance
now = datetime.now()
current_date = now.strftime("%Y-%m-%d")
csv_file_name = f'attendance_{current_date}.csv'

# Open the CSV file for writing
with open(csv_file_name, 'w', newline='') as csvfile:
    lnwriter = csv.writer(csvfile)

    while True:
        _, frame = video_capture.read()
        small_frame = cv2.resize(frame, (0, 0), fx=0.25, fy=0.25)
        rgb_small_frame = small_frame[:, :, ::-1]

        # Detect faces in the frame
        face_locations = face_recognition.face_locations(rgb_small_frame)
        face_encodings = face_recognition.face_encodings(rgb_small_frame, face_locations)
        face_names = []

        for face_encoding in face_encodings:
            matches = face_recognition.compare_faces(known_face_encoding, face_encoding)
            name = ""
            face_distance = face_recognition.face_distance(known_face_encoding, face_encoding)
            best_match_index = np.argmin(face_distance)

            if matches[best_match_index]:
                name = known_faces_names[best_match_index]

            face_names.append(name)

            if name in students:
                students.remove(name)
                current_time = now.strftime("%H:%M:%S")
                lnwriter.writerow([name, current_time])

        # Display the frame with recognized names
        for (top, right, bottom, left), name in zip(face_locations, face_names):
            top *= 4
            right *= 4
            bottom *= 4
            left *= 4

            cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)
            font = cv2.FONT_HERSHEY_DUPLEX
            cv2.putText(frame, name, (left + 6, bottom - 6), font, 0.5, (255, 255, 255), 1)

        cv2.imshow("Attendance System", frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

# Release video capture and close all windows
video_capture.release()
cv2.destroyAllWindows()
