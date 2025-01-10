import socket
import threading
import time

def read_scores():
    try:
        with open("scores_s.txt", "r") as file:
            lines = file.readlines()
            total_score = int(lines[0].split(":")[1].strip())
            current_score = int(lines[1].split(":")[1].strip())
            question = lines[2].split(":")[1].strip()
            return total_score, current_score, question
    except FileNotFoundError:
        with open("scores_s.txt", "w") as file:
            file.write("Total Score: 100\nCurrent Score: 0\nQuestion: No question\nAnswer: No answer\n")
        return 100, 0, "No question"

def write_scores(answer):
    try:
        with open("scores_s.txt", "r") as file:
            lines = file.readlines()
        with open("scores_s.txt", "w") as file:
            file.write(lines[0])
            file.write(lines[1])
            file.write(lines[2])  # 保留原有的 Question
            file.write(f"Answer: {answer}\n")
    except Exception as e:
        print(f"Error writing to file: {e}")

def handle_client(conn, addr):
    print(f"Connection from {addr}")
    try:
        while True:
            # 接收客户端数据
            data = conn.recv(1024).decode('utf-8').split("|")
            if not data:
                break
            client_total_score = data[0]
            client_current_score = data[1]
            client_question = data[2]
            print(f"Received from client: Total Score={client_total_score}, Current Score={client_current_score}, Question={client_question}")

            # 更新服务器的 Answer
            write_scores(client_question)

            # 读取服务器的分数和问题
            server_total_score, server_current_score, server_question = read_scores()

            # 将服务器的数据发送回客户端
            response = f"{server_total_score}|{server_current_score}|{server_question}"
            conn.sendall(response.encode('utf-8'))

            # 每 5 秒交换一次
            time.sleep(5)
    except Exception as e:
        print(f"Error handling client: {e}")
    finally:
        conn.close()

def start_server():
    server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    server.bind(("localhost", 5000))
    server.listen(5)
    print("Server listening on port 5000...")
    while True:
        conn, addr = server.accept()
        threading.Thread(target=handle_client, args=(conn, addr)).start()

if __name__ == "__main__":
    start_server()
