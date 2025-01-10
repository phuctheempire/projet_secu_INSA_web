import socket
import time

def read_scores():
    try:
        with open("scores.txt", "r") as file:
            lines = file.readlines()
            total_score = int(lines[0].split(":")[1].strip())
            current_score = int(lines[1].split(":")[1].strip())
            question = lines[2].split(":")[1].strip()
            return total_score, current_score, question
    except FileNotFoundError:
        with open("scores.txt", "w") as file:
            file.write("Total Score: 100\nCurrent Score: 0\nQuestion: No question\nAnswer: No answer\n")
        return 100, 0, "No question"

def append_to_client_record(total_score, current_score, question, server_question):
    try:
        with open("client_record.txt", "a") as file:
            # 将当前的四个信息追加到文件中的新一行
            file.write(f"Total_Score: {total_score}, Current_Score: {current_score}, Question: {question}, Answer: {server_question}\n")
    except Exception as e:
        print(f"Error appending to client_record.txt: {e}")

def write_scores(total_score, current_score, answer):
    try:
        with open("scores.txt", "r") as file:
            lines = file.readlines()
        with open("scores.txt", "w") as file:
            file.write(f"Total Score: {total_score}\n")
            file.write(f"Current Score: {current_score}\n")
            file.write(lines[2])  # 保留原有的 Question
            file.write(f"Answer: {answer}\n")
    except Exception as e:
        print(f"Error writing to file: {e}")

def client_interaction():
    client = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
    client.connect(("localhost", 5000))

    try:
        while True:
            # 读取客户端自己的数据
            total_score, current_score, question = read_scores()

            # 发送数据到服务器
            client_data = f"{total_score}|{current_score}|{question}"
            client.sendall(client_data.encode('utf-8'))

            # 接收服务器的数据
            server_data = client.recv(1024).decode('utf-8').split("|")
            server_total_score = server_data[0]
            server_current_score = server_data[1]
            server_question = server_data[2]
            print(f"Received from server: Total Score={server_total_score}, Current Score={server_current_score}, Question={server_question}")

            # 更新客户端的 Answer
            write_scores(server_total_score, server_current_score, server_question)

            append_to_client_record(server_total_score, server_current_score, question, server_question)
            # 每 5 秒交换一次
            time.sleep(5)
    except Exception as e:
        print(f"Error in client interaction: {e}")
    finally:
        client.close()

if __name__ == "__main__":
    client_interaction()
