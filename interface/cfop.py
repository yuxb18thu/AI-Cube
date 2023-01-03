import sys
import os
import pycuber as pc
from pycuber.solver import CFOPSolver
    

def CFOP(state):
    # state=[35, 34, 33, 1, 4, 7, 0, 3, 6, 11, 14, 17, 10, 13, 16, 20, 19, 18, 8, 23, 26, 5, 22, 25, 2, 21, 24, 29, 32, 15, 28, 31, 12, 27, 30, 9, 44, 43, 42, 41, 40, 39, 38, 37, 36, 47, 50, 53, 46, 49, 52, 45, 48, 51]
    # state=[2,5,8,1,4,7,24,25,26,  27,28,29,10,13,16,9,12,15,  20,23,11,19,22,14,18,21,17,  0, 32,35, 3,31,34, 6,30,33,  42,39,36,43,40,37,44,41,38, 45,46,47,48,49,50,51,52,53]
    # init=[2,5,8,1,4,7,0,3,6,     11,14,17,10,13,16,9,12,15,  20,23,26,19,22,25,18,21,24,  29,32,35,28,31,34,27,30,33,  42,39,36,43,40,37,44,41,38,  47,50,53,46,49,52,45,48,51]
    # i={}
    # for l in range(0,54):
    #     i[init[l]]=l
    i={2: 0, 5: 1, 8: 2, 1: 3, 4: 4, 7: 5, 0: 6, 3: 7, 6: 8, 11: 9, 14: 10, 17: 11, 10: 12, 13: 13, 16: 14, 9: 15, 12: 16, 15: 17, 20: 18, 23: 19, 26: 20, 19: 21, 22: 22, 25: 23, 18: 24, 21: 25, 24: 26, 29: 27, 32: 28, 35: 29, 28: 30, 31: 31, 34: 32, 27: 33, 30: 34, 33: 35, 42: 36, 39: 37, 36: 38, 43: 39, 40: 40, 37: 41, 44: 42, 41: 43, 38: 44, 47: 45, 50: 46, 53: 47, 46: 48, 49: 49, 52: 50, 45: 51, 48: 52, 51: 53}
    def num2color(num):
        num=state[i[num]]
        if(0<=num<=8):
            return pc.Square("white")
        if(9<=num<=17):
            return pc.Square("yellow")
        if(18<=num<=26):
            return pc.Square("orange")
        if(27<=num<=35):
            return pc.Square("red")
        if(36<=num<=44):
            return pc.Square("blue")
        if(45<=num<=53):
            return pc.Square("green")

    cubies = set()
    colours = {"R": "red", "D": "yellow", "F": "green", "U": "white", "L": "orange", "B": "blue"}
    for loc in [
        "LDB", "LDF", "LUB", "LUF", "RDB", "RDF", "RUB", "RUF",
        "LB", "LF", "LU", "LD", "DB", "DF", "UB", "UF", "RB", "RF", "RU", "RD",
        "L", "R", "U", "D", "F", "B",
    ]:
        if(loc=="LDB"):
            cubies.add(pc.Corner(L=num2color(18), D=num2color(9), B=num2color(42)))
        if(loc=="LDF"):
            cubies.add(pc.Corner(L=num2color(24), D=num2color(11), F=num2color(45)))
        if(loc=="LUB"):
            cubies.add(pc.Corner(L=num2color(20), U=num2color(2), B=num2color(44)))
        if(loc=="LUF"):
            cubies.add(pc.Corner(L=num2color(26), U=num2color(0), F=num2color(47)))
        if(loc=="RDB"):
            cubies.add(pc.Corner(R=num2color(33), D=num2color(15), B=num2color(36)))
        if(loc=="RDF"):
            cubies.add(pc.Corner(R=num2color(27), D=num2color(17), F=num2color(51)))
        if(loc=="RUB"):
            cubies.add(pc.Corner(R=num2color(35), U=num2color(8), B=num2color(38)))
        if(loc=="RUF"):
            cubies.add(pc.Corner(R=num2color(29), U=num2color(6), F=num2color(53)))
        
        if(loc=="LB"):
            cubies.add(pc.Edge(L=num2color(19), B=num2color(43)))
        if(loc=="LF"):
            cubies.add(pc.Edge(L=num2color(25), F=num2color(46)))
        if(loc=="LU"):
            cubies.add(pc.Edge(L=num2color(23), U=num2color(1)))
        if(loc=="LD"):
            cubies.add(pc.Edge(L=num2color(21), D=num2color(10)))
        if(loc=="DB"):
            cubies.add(pc.Edge(D=num2color(12), B=num2color(39)))
        if(loc=="DF"):
            cubies.add(pc.Edge(D=num2color(14), F=num2color(48)))
        if(loc=="UB"):
            cubies.add(pc.Edge(U=num2color(5), B=num2color(41)))
        if(loc=="UF"):
            cubies.add(pc.Edge(U=num2color(3), F=num2color(50)))
        if(loc=="RB"):
            cubies.add(pc.Edge(R=num2color(34), B=num2color(37)))
        if(loc=="RF"):
            cubies.add(pc.Edge(R=num2color(28), F=num2color(52)))
        if(loc=="RU"):
            cubies.add(pc.Edge(R=num2color(32), U=num2color(7)))
        if(loc=="RD"):
            cubies.add(pc.Edge(R=num2color(30), D=num2color(16)))
        # if len(loc) == 3:

        #     cubies.add(pc.Corner(**{loc[i]: pc.Square(colours[loc[i]]) for i in range(3)}))
        # elif len(loc) == 2:
        #     cubies.add(pc.Edge(**{loc[i]: pc.Square(colours[loc[i]]) for i in range(2)}))
        else:
            cubies.add(pc.Centre(**{loc[0]: pc.Square(colours[loc[0]])}))
    cubies = set(cubies)

    c = pc.Cube(cubies)
    print(c)
    solver = CFOPSolver(c)

    solution = solver.solve(suppress_progress_messages=True)

    r={"moves":[],"moves_rev":[],"solve_text":[]}
    for s in solution:
        s=str(s)
        if len(s)==1:
            r["moves"].append(s+'_1')
            r["moves_rev"].append(s+'_-1')
            r["solve_text"].append(s)
        if len(s)==2 and s[1]=='\'':
            r["moves"].append(s[0]+'_-1')
            r["moves_rev"].append(s[0]+'_1')
            r["solve_text"].append(s)
        if len(s)==2 and s[1]=='2':
            r["moves"].append(s[0]+'_1')
            r["moves_rev"].append(s[0]+'_-1')
            r["solve_text"].append(s[0])
            r["moves"].append(s[0]+'_1')
            r["moves_rev"].append(s[0]+'_-1')
            r["solve_text"].append(s[0])
    return r