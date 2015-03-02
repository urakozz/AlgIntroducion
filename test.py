import random
import time


class Resolver:

    res = {}

    def __init__(self, amount, rand):
        self.amount = amount
        self.rand = rand
        self.numbers = []

    def fill(self):
        for i in range(self.amount):
            self.numbers.append(random.randint(0, self.rand))

    def resolve(self):
        pass


class NormalResolver(Resolver):

    def resolve(self):
        print 'resolver begins'

        for i in self.numbers:
            self.res[i] = self.res.get(i, 0) + 1
        for key in list(self.res.iterkeys()):
            if self.res[key] % 2 == 0:
                del self.res[key]


class Processor:

    t0 = 0
    t1 = 0

    def __init__(self, resolver):
        if not isinstance(resolver, Resolver):
            raise Exception('resolver should be instance of Resolver')
        self.resolver = resolver

    def generate(self):
        self.resolver.fill()
        self.t0 = time.time()
        return self

    def solve(self):
        self.resolver.resolve()
        self.t1 = time.time()
        return self

    def print_benchmark(self):
        print "done in: ", time.time() - self.t0
        print "total: ", time.time() - self.t1
        return self


x = input("Input amount:\n")
r = input("Input range:\n")
print ">>>"

proc = Processor(NormalResolver(x, r)).generate().solve().print_benchmark()
for k, v in proc.resolver.res.iteritems():
    print k, ' -> ', v

